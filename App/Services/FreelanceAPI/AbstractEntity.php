<?php

namespace App\Services\FreelanceAPI;

/**
 * Class AbstractEntity
 * @package App\Services\FreelanceAPI
 */
abstract class AbstractEntity
{
    protected $data = [];

    /**
     * @return mixed
     */
    abstract public function attributesList();

    /**
     * @param $name
     * @return mixed|null
     */
    public function __get($name)
    {
        return $this->data[$name] ?? null;
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    /**
     * @param $name
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->data[$name]);
    }

    /**
     * @return mixed
     */
    public function toArray()
    {
        return json_decode(json_encode($this->data), true);
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
}