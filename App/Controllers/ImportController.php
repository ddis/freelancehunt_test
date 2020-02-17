<?php

namespace App\Controllers;

use App\Services\Import\Import;
use Kernel\Controller;

/**
 * Class ImportController
 * @package App\Controllers
 */
class ImportController extends Controller
{
    /**
     * @return bool
     */
    public function start()
    {
        $service = new Import();

        if (!$service->checkStartedImport()) {
            $service->runImport();

            return $this->renderJson([
                "status" => "success",
            ]);
        }

        return $this->renderJson([
            "status" => "fail",
        ]);
    }

    /**
     * @return bool
     */
    public function check()
    {
        $service = new Import();

        return $this->renderJson([
            "status" => $service->checkStartedImport() ? "false" : "success",
        ]);
    }
}