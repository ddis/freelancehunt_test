<?php

namespace App\Models;

use Kernel\Model;

/**
 * Class Employer
 * @package App\Models
 */
class Employer extends Model
{
    public static function tableName(): string
    {
        return "employer";
    }

    static function saveFields(): array
    {
        return [
            "login",
            "last_name",
            "first_name",
        ];
    }

    public function findOrCreate($data)
    {
        if (!isset($data['id'])) {
            throw new \Exception("Id not set", 406);
        }

        if ($res = $this->findOne(['id' => $data['id']])) {
            return $res['id'];
        }

        if ($this->insert($this->prepareData($data))) {
            return $this->lastInsertId();
        }

        throw new \Exception("Can't create employer");
    }

    protected function prepareData($data)
    {
        return $this->filterData($data, array_merge(self::saveFields(), ['id']));
    }
}