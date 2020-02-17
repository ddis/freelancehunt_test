<?php

namespace App\Widgets;

use Kernel\App;
use Kernel\Route;
use Kernel\Services\ConfigManager;
use Kernel\Widget;

/**
 * Class MenuWidget
 * @package App\Widgets
 */
class MenuWidget extends Widget
{
    /**
     * @return false|string
     */
    public function run()
    {
        $items = array_map(function ($item) {
            $item['active'] = $this->isActiveItem($item['route']);

            return $item;
        }, $this->getConfigManager()->get("menu"));

        return $this->render("menu", ['items' => $items]);
    }

    /**
     * @return ConfigManager
     */
    protected function getConfigManager(): ConfigManager
    {
        return App::getInstance()->get("configManager");
    }

    /**
     * @param string $route
     * @return bool
     */
    protected function isActiveItem(string $route)
    {
        $routeEl = explode("/", Route::getInstance()->getCurrentUrl());

        return ("/" . $routeEl[1]) == $route;
    }
}