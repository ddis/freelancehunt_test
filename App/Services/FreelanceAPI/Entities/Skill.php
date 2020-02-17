<?php

namespace App\Services\FreelanceAPI\Entities;

use App\Services\FreelanceAPI\AbstractEntity;

/**
 * Class Freelancer
 * @package App\Services\FreelanceAPI\Entities
 *
 * @property $id
 * @property $name
 *
 */
class Skill extends AbstractEntity
{
    /**
     * @return array
     */
    public function attributesList()
    {
        return [];
    }

    /**
     * @return $this
     */
    protected function mapData()
    {
        $this->id   = $this->response->id;
        $this->name = $this->response->name;

        return $this;
    }
}