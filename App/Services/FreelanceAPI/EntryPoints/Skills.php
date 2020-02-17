<?php

namespace App\Services\FreelanceAPI\EntryPoints;

use App\Services\FreelanceAPI\AbstractEntryPoint;
use App\Services\FreelanceAPI\Entities\Skill;
use App\Services\FreelanceAPI\Mappers\BaseMapper;
use App\Services\FreelanceAPI\Mappers\SkillsMapper;

/**
 * Class Skills
 * @package App\Services\FreelanceAPI\EntryPoints
 */
class Skills extends AbstractEntryPoint
{
    protected $url    = "skills";
    protected $entity = null;

    /**
     * Skills constructor.
     * @throws \ErrorException
     */
    public function __construct()
    {
        parent::__construct();

        $this->entity = new Skill();
    }

    /**
     *
     */
    protected function setMapper()
    {
        $this->mapper = new SkillsMapper();
    }


}