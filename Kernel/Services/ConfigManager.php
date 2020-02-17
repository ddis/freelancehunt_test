<?php

namespace Kernel\Services;

/**
 * Class ConfigManager
 * @package Kernel\Services
 */
class ConfigManager
{
    private $config = [];

    /**
     * ConfigManager constructor.
     */
    public function __construct()
    {
        $this->loadFromFile();
    }

    /**
     * @param string $path
     * @return array|mixed|null
     */
    public function get(string $path)
    {
        $elements = explode(".", $path);
        $res      = $this->config;

        foreach ($elements as $element) {
            if (!isset($res[$element])) {
                return null;
            }

            $res = $res[$element];
        }

        return $res;
    }

    /**
     * @param string $path
     * @param        $value
     * @return $this
     */
    public function set(string $path, $value)
    {
        $elements = explode(".", $path);
        $res      =& $this->config;

        foreach ($elements as $element) {
            if (!isset($res[$element])) {
                $res[$element] = [];
            }

            $res =& $res[$element];
        }

        $res = $value;

        return $this;
    }

    /**
     * @return bool|int
     */
    public function save()
    {

        return file_put_contents(
            CORE_PATH . "/config/config.json",
            json_encode($this->config, JSON_PRETTY_PRINT)
        );
    }

    /**
     *
     */
    protected function loadFromFile()
    {
        $this->config = json_decode(file_get_contents(CORE_PATH . "/config/config.json"), true);
    }
}