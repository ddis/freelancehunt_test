<?php

namespace Kernel;

use Kernel\Services\ConfigManager;

/**
 * Class Widget
 * @package Kernel
 */
abstract class Widget
{
    private static $instances = [];
    private        $view      = null;
    protected      $data      = [];

    /**
     * @param $data
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @param string $name
     * @param array  $data
     * @return false|string
     */
    public function render(string $name, $data = [])
    {
        $this->view = new Template();

        return $this->view->display($name, $data, CORE_PATH . "App/Widgets/Views/");
    }

    /**
     * @param array $data
     * @return mixed
     */
    public static function widget(array $data = [])
    {
        $class = static::class;

        if (!isset(self::$instances[$class])) {
            self::$instances[$class] = new static();
        }

        return self::$instances[$class]->setData($data)->run();
    }

    /**
     * @return mixed
     */
    abstract public function run();

    /**
     * @return ConfigManager
     */
    protected function getConfigManager(): ConfigManager
    {
        return App::getInstance()->get("configManager");
    }
}