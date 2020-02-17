<?php

namespace App\Controllers;

use App\Models\Projects;
use App\Models\Skills;
use Kernel\Controller;

/**
 * Class ProjectsController
 * @package App\Controllers
 */
class ProjectsController extends Controller
{

    /**
     * @return bool
     */
    public function index()
    {
        $projectModel = new Projects();
        $skills       = new Skills();

        $activeSkills = $skills->getActiveSkills();
        $total        = $projectModel->total();

        $onPage = $this->getConfigManager()->get("pagination.onPage");
        $offset = ((isset($_GET['page']) ? (int)$_GET['page'] : 1) - 1) * $onPage;

        $projectList = $projectModel->getProjectWithEmployers($onPage, $offset);

        return $this->render("projects/list", [
            "total"        => $total,
            "activeSkills" => implode(", ", $activeSkills),
            "projectList"  => $projectList,
        ]);
    }

    /**
     * @return bool
     */
    public function skills()
    {
        $skills = new Skills();

        $activeSkills = $skills->getActiveSkills();
        $total        = $skills->getTotalSkillsWithProjects();

        $onPage = $this->getConfigManager()->get("pagination.onPage");
        $offset = ((isset($_GET['page']) ? (int)$_GET['page'] : 1) - 1) * $onPage;

        return $this->render('projects/skills', [
            "activeSkills"     => implode(", ", $activeSkills),
            "total"            => $total,
            "list"             => $skills->getSkillsWithProjectCount($onPage, $offset),
            "startPosition"    => $offset,
            "activeSkillsList" => $this->getConfigManager()->get("skills_category"),
        ]);
    }

    /**
     * @return bool
     */
    public function graphs()
    {
        return $this->render("projects/graphs");
    }
}