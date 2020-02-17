<?php

$router = \Kernel\Route::getInstance();

#region index
$router->get('\/', [\App\Controllers\IndexController::class, 'index']);
#endrgion

#region settings
$router->get("\/settings", [\App\Controllers\SettingsController::class, "index"]);
$router->post("\/settings\/skills", [\App\Controllers\SettingsController::class, "updateSkills"]);
#endregion

#region dynamic
$router->get("\/dynamic\/modals\/install", [\App\Controllers\Dynamic\ModalsController::class, "install"]);
$router->get("\/dynamic\/modals\/import-progress", [\App\Controllers\Dynamic\ModalsController::class, "importProgress"]);
#endregion

#region install
$router->post("\/install\/set-api-key", [\App\Controllers\InstallController::class, "setApiKey"]);
$router->post("\/install\/set-db-connect", [\App\Controllers\InstallController::class, "setDbConnect"]);
$router->post("\/install\/finish", [\App\Controllers\InstallController::class, "finish"]);
$router->get("\/install\/check-install-system", [\App\Controllers\InstallController::class, 'checkInstall']);
#endregion

#region import
$router->get("\/import\/start", [\App\Controllers\ImportController::class, "start"]);
$router->get("\/import\/check", [\App\Controllers\ImportController::class, "check"]);
#endregion

#region projects
$router->get('\/projects', [\App\Controllers\ProjectsController::class, "index"]);
$router->get('\/projects\/skills', [\App\Controllers\ProjectsController::class, "skills"]);
$router->get("\/projects\/graphs", [\App\Controllers\ProjectsController::class, "graphs"]);
#endregion

#region API
$router->get("\/api\/v1\/charts\/by-price", [\App\Controllers\Api\v1\ChartsController::class, "byPrice"]);
$router->get("\/api\/v1\/charts\/top-skills", [\App\Controllers\Api\v1\ChartsController::class, "topSkills"]);
#endregion