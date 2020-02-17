<?php

namespace App\Services\Import;

use App\Models\ImportHistory;
use App\Services\FreelanceAPI\EntryPoints\Projects;
use App\Services\FreelanceAPI\FreelanceAPI;
use Kernel\App;
use Kernel\Services\ConfigManager;

/**
 * Class Import
 * @package App\Services\Import
 */
class Import
{
    public $model = null;

    /**
     * Import constructor.
     */
    public function __construct()
    {
        $this->model = new ImportHistory();
    }

    /**
     * @return bool
     */
    public function checkStartedImport()
    {
        $res = $this->model->getStarted();

        return $res ? true : false;
    }

    /**
     * Run import method
     */
    public function runImport()
    {
        $php = App::getInstance()->getPhpBin();

        exec("{$php} " . PUBLIC_PATH . "/console.php import/import-data >/dev/null 2>&1 &");
    }

    /**
     * Import data method
     */
    public function importData()
    {
        $api     = new FreelanceAPI();
        $service = new \App\Services\Projects();

        $hasPages = true;
        $page     = 1;
        $skills   = implode(",", $this->getConfigManager()->get("skills_category"));

        $service->clearData();

        $this->model->insert([
            "status" => ImportHistory::STATUS_PENDING,
            "name"   => "Project import",
            "skills" => implode(",", $this->getConfigManager()->get("skills_category")),
        ]);

        try {
            while ($hasPages) {
                $projects = $api->setEntryPoint(new Projects($page, $skills))->getCollection();
                if (isset($projects->getPagination()->next)) {
                    $page++;
                } else {
                    $hasPages = false;
                }

                array_walk($projects->toArray(), function ($item) use ($service) {
                    $service->insertProjectFromImport($item);
                });
            }

            $this->model->update([
                "status"      => ImportHistory::STATUS_SUCCESS,
            ], "status = '" . ImportHistory::STATUS_PENDING . "'");
        } catch (\Exception $exception) {
            $this->model->update([
                "status"      => ImportHistory::STATUS_FAIL,
            ], "status = '" . ImportHistory::STATUS_PENDING . "'");
        }
    }

    /**
     * @return ConfigManager
     */
    protected function getConfigManager(): ConfigManager
    {
        return App::getInstance()->get("configManager");
    }
}