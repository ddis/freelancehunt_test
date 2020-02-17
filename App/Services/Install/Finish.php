<?php

namespace App\Services\Install;

use App\Services\FreelanceAPI\EntryPoints\Skills;
use App\Services\FreelanceAPI\FreelanceAPI;
use Kernel\App;
use Kernel\Services\ConfigManager;

/**
 * Class Finish
 * @package App\Services\Install
 */
class Finish
{
    /**
     * @return bool
     */
    public function createDB()
    {
        $messages = [];
        $result   = 0;

        exec("vendor/bin/phinx migrate -e development", $messages, $result);

        return $result === 0 ? true : false;
    }

    /**
     * @return bool
     * @throws \App\Services\FreelanceAPI\Exceptions\ClassNotExist
     * @throws \App\Services\FreelanceAPI\Exceptions\CurlError
     * @throws \App\Services\FreelanceAPI\Exceptions\JsonError
     * @throws \ErrorException
     */
    public function initCategories()
    {
        $api   = new FreelanceAPI();
        $model = new \App\Models\Skills();

        $collection = $api->setEntryPoint(new Skills())->getCollection();

        $values = array_map(function ($item) {
            return array_values($item);
        }, $collection->toArray());

        if (count($collection)) {
            if ($model->batchInsert($values, ['id', 'name'])) {
                return true;
            }

            return false;

        }

        return true;
    }

    /**
     * Finish install method
     */
    public function finish()
    {
        $this->getConfigManager()->set("isInstalled", true)->save();

        setcookie("isInstalled", true);
    }

    /**
     * @return ConfigManager
     */
    protected function getConfigManager(): ConfigManager
    {
        return App::getInstance()->get("configManager");
    }

}