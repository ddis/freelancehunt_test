<?php


namespace Kernel;

use App\Controllers\ErrorController;
use Kernel\Services\ConfigManager;

/**
 * Class App
 *
 * @package kernel
 */
class App
{
    const DEFAULT_CONSOLE_PATH = "index";

    private static $instance      = null;
    private        $configManager = null;

    /**
     * App constructor.
     */
    private function __construct()
    {
        $this->configManager = new ConfigManager();
    }

    /**
     * Clone method
     */
    private function __clone() { }

    /**
     * Wakeup method
     */
    private function __wakeup() { }

    /**
     * @throws \Exception
     */
    public static function run(): void
    {
        try {
            list($function, $params) = Route::getInstance()->run();

            if (!class_exists($function[0])) {
                throw new \Exception("Class {$function[0]} not found", 500);
            }
            (new $function[0])->{$function[1]}(...$params);
        } catch (\Exception $exception) {

            http_response_code($exception->getCode() ?? 500);

            if (stripos($_SERVER["HTTP_ACCEPT"], "json") === false) {
                switch ($exception->getCode()) {
                    case 404:
                    case 405:
                        (new ErrorController())->notFound();
                        break;
                    default:
                        throw $exception;
                }
            }
        }
    }

    /**
     * @param $argv
     * @throws \Exception
     */
    public static function runConsole($argv): void
    {
        $path   = empty($argv[1]) ? self::DEFAULT_CONSOLE_PATH : $argv[1];
        $params = array_slice($argv, 2);

        $function = RouteConsole::getInstance()->run($path);

        try {
            if (!class_exists($function[0])) {
                throw new \Exception("Class {$function[0]} not found", 500);
            }
            (new $function[0])->{$function[1]}(...$params);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @return App|null
     */
    public static function getInstance(): App
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @param string $name
     * @return |null
     */
    public function get(string $name)
    {
        if (!property_exists($this, $name)) {
            return null;
        }

        return $this->{$name};
    }

    /**
     * Get path to PHP
     *
     * @return string
     */
    public function getPhpBin()
    {
        if (isset($_SERVER['PHP_PATH']) && !empty($_SERVER['PHP_PATH'])) {
            return $_SERVER['PHP_PATH'];
        }

        return defined("PHP_BINDIR") ? PHP_BINDIR . DIRECTORY_SEPARATOR . 'php' : 'php';
    }
}
