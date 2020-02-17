<?php
defined("CORE_PATH") or define("CORE_PATH", __DIR__ . "/../");

require_once CORE_PATH . "/vendor/autoload.php";
include_once CORE_PATH . "/config/console.php";

try {
    Kernel\App::runConsole($argv);
} catch (\Exception $exception) {
    throw $exception;
}