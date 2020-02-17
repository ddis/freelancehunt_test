<?php

namespace App\Services\FreelanceAPI\Mappers;

use App\Services\FreelanceAPI\AbstractEntity;

/**
 * Class SkillsMapper
 * @package App\Services\FreelanceAPI\Mappers
 */
class SkillsMapper extends BaseMapper
{
    /**
     * @param                $data
     * @param AbstractEntity $entity
     * @return AbstractEntity
     */
    public function map($data, AbstractEntity $entity): AbstractEntity
    {
        $entity->id   = $data->id;
        $entity->name = $data->name;

        return $entity;
    }
}