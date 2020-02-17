<?php

namespace Kernel;

use Kernel\DB\DB;

/**
 * Class Model
 * @package Kernel
 */
abstract class Model extends DB
{
    /**
     * @return array
     */
    abstract static function saveFields(): array;

    /**
     * @param array $data
     * @param array $keys
     * @return array
     */
    public function filterData(array $data, array $keys = [])
    {
        $keys = $keys ? $keys : static::saveFields();

        $keys = array_filter(array_keys($data), function ($item) use ($keys) {
            return in_array($item, $keys);
        });

        return array_intersect_key($data, array_flip($keys));
    }
}
