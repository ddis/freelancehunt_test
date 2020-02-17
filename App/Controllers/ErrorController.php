<?php

namespace App\Controllers;

use Kernel\Controller;

/**
 * Class ErrorController
 * @package App\Controllers
 */
class ErrorController extends Controller
{
    /**
     * @return bool
     */
    public function notFound()
    {
        return $this->render('error/not-found');
    }
}