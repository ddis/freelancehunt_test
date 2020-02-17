<?php

namespace App\Services\FreelanceAPI\Mappers;

use App\Services\FreelanceAPI\AbstractEntity;

/**
 * Class BaseMapper
 * @package App\Services\FreelanceAPI\Mappers
 */
class BaseMapper
{
    /**
     * @param                $data
     * @param AbstractEntity $entity
     * @return AbstractEntity
     */
    public function map($data, AbstractEntity $entity): AbstractEntity
    {
        $entity->id = $data->id;

        foreach ($entity->attributesList() as $item) {
            $methodName = "__set{$this->normalizeName($item)}";
            if (method_exists($entity, $methodName)) {
                $entity->{$item} = $entity->$methodName($data);
            } else {
                $entity->{$item} = $data->attributes->{$item};
            }
        }

        return $entity;
    }

    /**
     * @param string $name
     * @param string $separator
     * @return string
     */
    protected function normalizeName(string $name, string $separator = "_"): string
    {
        return str_replace($separator, '', ucwords($name, $separator));
    }
}