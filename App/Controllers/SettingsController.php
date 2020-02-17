<?php

namespace App\Controllers;

use App\Models\Skills;
use Kernel\Controller;
use Kernel\ValidationData;

/**
 * Class SettingsController
 * @package App\Controllers
 */
class SettingsController extends Controller
{
    /**
     *
     */
    public function index()
    {
        $model = new Skills();

        $data = $model->findAll();

        $this->render("settings/index", [
            'data'     => $data,
            'selected' => $this->getConfigManager()->get("skills_category"),
        ]);
    }

    /**
     * @return bool
     */
    public function updateSkills()
    {
        $validator = new ValidationData();

        $validator->setData($_POST)
                  ->addRules([
                      [['skills'], ValidationData::VALIDATE_ARRAY],
                  ])->validate();

        if ($validator->hasErrors()) {
            return $this->renderJson([
                'status' => 'validation-fail',
            ]);
        }

        $data = $validator->getData();

        return $this->renderJson([
            'status' => $this->getConfigManager()->set("skills_category", $data['skills'])->save() ? "success" : "fail",
        ]);
    }
}