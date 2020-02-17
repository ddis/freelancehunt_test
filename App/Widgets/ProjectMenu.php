<?php

namespace App\Widgets;

use Kernel\Widget;

/**
 * Class ProjectMenu
 * @package App\Widgets
 */
class ProjectMenu extends Widget
{

    const LIST = [
        "project" => [
            "name" => "Список",
            "url"  => "/projects",
        ],
        "skills"  => [
            "name" => "По навыкам",
            "url"  => "/projects/skills",
        ],
        "graphs"  => [
            "name" => "Графики",
            "url"  => "/projects/graphs",
        ],
    ];

    /**
     * @return false|string
     */
    public function run()
    {
        return $this->render('project-menu', [
            'items'  => self::LIST,
            "active" => $this->data['active'],
        ]);
    }
}