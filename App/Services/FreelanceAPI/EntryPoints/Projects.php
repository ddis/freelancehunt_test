<?php

namespace App\Services\FreelanceAPI\EntryPoints;

use App\Services\FreelanceAPI\AbstractEntryPoint;

/**
 * Class Projects
 * @package App\Services\FreelanceAPI\EntryPoints
 */
class Projects extends AbstractEntryPoint
{
    protected $url = "projects";

    /**
     * Projects constructor.
     * @param int    $page
     * @param string $skills
     * @throws \ErrorException
     */
    public function __construct(int $page, string $skills)
    {
        parent::__construct();

        $get[] = "page[number]={$page}";
        $get[] = "filter[skill_id]={$skills}";

        $get = implode("&", $get);

        $this->url = "{$this->url}?{$get}";
    }
}