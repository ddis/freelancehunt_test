<?php

namespace App\Services\FreelanceAPI\Entities;

use App\Services\FreelanceAPI\AbstractEntity;

/**
 * Class Freelancer
 * @package App\Services\FreelanceAPI\Entities
 *
 * @property $id
 * @property $login
 * @property $first_name
 * @property $last_name
 * @property $small_avatar
 *
 */
class Freelancer extends AbstractEntity
{
    /**
     * @return array
     */
    public function attributesList()
    {
        return [
            "login",
            "first_name",
            "last_name",
            "small_avatar",
        ];
    }

    /**
     * @param $data
     * @return mixed
     */
    public function __setSmallAvatar($data)
    {
        return $data->attributes->avatar->small;
    }
}