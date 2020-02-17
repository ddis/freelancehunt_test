<?php
namespace App\Console;

use App\Models\ImportHistory;
use Kernel\Console;

/**
 * Class Import
 * @package App\Console
 */
class Import extends Console
{
    /**
     * @return bool
     */
    public function importData()
    {
        $service = new \App\Services\Import\Import();

        if ($service->checkStartedImport()) {
            return false;
        }

        $service->importData();
    }
}