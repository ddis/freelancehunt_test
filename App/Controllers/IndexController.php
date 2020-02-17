<?php

namespace App\Controllers;

use App\Models\Projects;
use App\Models\Skills;
use Kernel\Controller;

/**
 * Class IndexController
 *
 * @package app\controllers
 */
class IndexController extends Controller
{
    /**
     * @return bool
     */
    public function index()
    {
        if (!$this->getConfigManager()->get("isInstalled")) {
            return $this->render("empty");
        }
        $projectList = (new Projects())->getNewProjects();
        $topSkills   = (new Skills())->topSkills();

        return $this->render('index/index', [
            'projectList' => $projectList,
            'topSkills'   => $topSkills,
        ]);
    }
}
