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
class Project extends AbstractEntity
{
    /**
     * @return array
     */
    public function attributesList()
    {
        return [
            "name",
            "description",
            "skills",
            "budget_amount",
            "budget_currency",
            "link_web",
            "employer",
            "published_at",
            "expired_at",
        ];
    }

    /**
     * @param $data
     * @return |null
     */
    public function __setBudgetAmount($data)
    {
        return $data->attributes->budget->amount ?? null;
    }

    /**
     * @param $data
     * @return |null
     */
    public function __setBudgetCurrency($data)
    {
        return $data->attributes->budget->currency ?? null;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function __setLinkWeb($data)
    {
        return $data->links->self->web;
    }

    /**
     * @param $data
     * @return array
     */
    public function __setSkills($data)
    {
        return array_map(function ($item) {
            return $item->id;
        }, $data->attributes->skills);
    }
}