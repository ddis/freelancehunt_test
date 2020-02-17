<?php

namespace Kernel;

/**
 * Class RouteConsole
 * @package Kernel
 */
class RouteConsole
{
    private static $instance = null;
    private        $routs    = [];

    /**
     * RouteConsole constructor.
     */
    private function __construct() { }

    private function __clone() { }

    /**
     * @return RouteConsole
     */
    public static function getInstance(): RouteConsole
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @param $path
     * @return mixed|null
     */
    public function run($path)
    {
        return $this->routs[$path] ?? null;
    }

    /**
     * @param string $pattern
     * @param array  $params
     * @return RouteConsole
     */
    public function setRoute(string $pattern, array $params): RouteConsole
    {
        $this->routs[$pattern] = $params;

        return $this;
    }
}