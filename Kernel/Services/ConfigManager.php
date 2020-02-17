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
        $config = var_export($this->config, true);

        return file_put_contents(
            CORE_PATH . "/config/configs.php",
            "<?php " . PHP_EOL . "return " . $config . ";" . PHP_EOL);
    }

    /**
     *
     */
    protected function loadFromFile()
    {
        $this->config = require_once CORE_PATH . "/config/configs.php";
    }
}