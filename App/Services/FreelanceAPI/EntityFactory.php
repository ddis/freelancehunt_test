<?php

namespace App\Services\FreelanceAPI;

use App\Services\FreelanceAPI\Exceptions\ClassNotExist;

/**
 * Class EntityFactory
 * @package App\Services\FreelanceAPI
 */
class EntityFactory
{
    /**
     * @param string $name
     * @return AbstractEntity
     * @throws ClassNotExist
     */
    public static function createInstance(string $name): AbstractEntity
    {
        $className = "\\" . __NAMESPACE__ . "\\Entities\\" . ucfirst($name);

        if (!class_exists($className)) {
            throw new ClassNotExist("Entity {$name} not exist");
        }

        return new $className();
    }
}