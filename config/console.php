<?php

$routes = \Kernel\RouteConsole::getInstance();

$routes->setRoute("import/import-data", [\App\Console\Import::class, "importData"]);