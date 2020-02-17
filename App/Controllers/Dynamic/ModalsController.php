<?php

namespace App\Controllers\Dynamic;

use Kernel\Controller;

/**
 * Class ModalsController
 * @package App\Controllers\Dynamic
 */
class ModalsController extends Controller
{
    /**
     *
     */
    public function install()
    {
        $html = $this->renderFile("modals/install", []);

        $this->renderJson([
            "html" => $html
        ]);
    }

    /**
     *
     */
    public function importProgress()
    {
        $html = $this->renderFile("modals/import-progress", []);

        $this->renderJson([
            "html" => $html
        ]);
    }
}