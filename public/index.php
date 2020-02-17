<?php
define('ENVIRONMENT', "dev");

defined("CORE_PATH") or define("CORE_PATH", __DIR__ . "/../");
defined("PUBLIC_PATH") or define("PUBLIC_PATH", __DIR__);

include_once CORE_PATH . "/vendor/autoload.php";
include_once CORE_PATH . "/config/init.php";

if (preg_match('/\.(?:png|jpg|jpeg|gif|css|js|ico|eot|svg|ttf|woff|woff2)[\?\w\W]*$/', $_SERVER["REQUEST_URI"])) {
    return false;
}
try {
    Kernel\App::run();
} catch (\Exception $exception) {

}
