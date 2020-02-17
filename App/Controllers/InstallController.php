<?php

namespace App\Controllers;

use App\Models\Install;
use App\Services\FreelanceAPI\FreelanceAPI;
use App\Services\Install\Finish;
use Kernel\App;
use Kernel\Controller;
use Kernel\Services\ConfigManager;
use Kernel\ValidationData;

/**
 * Class InstallController
 * @package App\Controllers
 */
class InstallController extends Controller
{
    /**
     * @return bool
     * @throws \App\Services\FreelanceAPI\Exceptions\ClassNotExist
     * @throws \App\Services\FreelanceAPI\Exceptions\CurlError
     * @throws \App\Services\FreelanceAPI\Exceptions\JsonError
     */
    public function setApiKey()
    {
        $api       = new FreelanceAPI();
        $validator = new ValidationData();

        $validator->setData($_POST)
                  ->addRules([
                      [
                          ['api-key'],
                          ValidationData::VALIDATE_REQUIRED,
                          "message" => "Поле :field: обязательно для заполения",
                      ],
                  ])->validate();

        if ($validator->hasErrors()) {
            return $this->renderJson([
                'status' => "validation-error",
                "error"  => $validator->getMessages(),
            ], new \Exception("Bad Request", 406));
        }

        $key = $validator->getData();

        $this->getConfigManager()
             ->set("API-key", $key['api-key']);

        if ($api->validateKey($key['api-key'])) {
            $this->getConfigManager()
                 ->save();

            return $this->renderJson([
                "status" => "success",
            ]);
        }

        return $this->renderJson([
            "status"  => "fail",
            "message" => "Ошибка авторизации. Проверте ключ.",
        ], new \Exception("Bad Request", 406));
    }

    /**
     *
     */
    public function checkInstall()
    {
        $isInstalled = App::getInstance()->get("configManager")->get("isInstalled");

        $this->renderJson([
            "isInstalled" => $isInstalled ? true : false,
        ]);
    }

    /**
     * @return bool
     */
    public function setDbConnect()
    {
        $validator = new ValidationData();

        $validator->setData($_POST['db'])
                  ->addRules([
                      [
                          ["host", "database", "user", "password"],
                          ValidationData::VALIDATE_REQUIRED,
                          "message" => "Поле :field: обязательно для заполения",
                      ],
                  ])->validate();

        if ($validator->hasErrors()) {
            return $this->renderJson([
                'status' => "validation-error",
                "error"  => $validator->getMessages(),
            ], new \Exception("Bad Request", 406));
        }

        $db = $this->getConfigManager()->get("db");

        $this->getConfigManager()->set("db", array_merge($db, $validator->getData()))->save();

        try {
            $model = new Install();

            return $this->renderJson([
                'status' => 'success',
            ]);
        } catch (\Exception $exception) {
            $this->getConfigManager()->set("db", $db)->save();

            return $this->renderJson([
                'status'  => 'fail',
                "message" => "Неудалось подключиться к базе данных",
            ], new \Exception("Bad Request", 406));
        }

    }

    /**
     * @return bool
     */
    public function finish()
    {
        $installService = new Finish();

        if (!$installService->createDB()) {
            return $this->renderJson([
                "status"  => "fail",
                "message" => "Ошибка миграции базы данных",
            ], new \Exception("Bad Request", 406));
        }

        if (!$installService->initCategories()) {
            return $this->renderJson([
                "status"  => "fail",
                "message" => "Ошибка инициализаци категорий",
            ], new \Exception("Bad Request", 406));
        }

        $installService->finish();

        return $this->renderJson([
            "status" => "success",
        ]);
    }
}