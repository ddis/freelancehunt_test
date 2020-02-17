<?php

namespace App\Services\FreelanceAPI;

use App\Services\FreelanceAPI\EntryPoints\MyProfile;

/**
 * Class FreelanceAPI
 * @package App\Services\FreelanceAPI
 */
class FreelanceAPI
{
    /**
     * @param AbstractEntryPoint $base
     * @return AbstractEntryPoint
     */
    public function setEntryPoint(AbstractEntryPoint $base)
    {
        return $base;
    }

    /**\
     * @throws Exceptions\ClassNotExist
     * @throws Exceptions\CurlError
     * @throws Exceptions\JsonError
     */
    public function validateKey()
    {
        try {
            $res = $this->setEntryPoint(new MyProfile())->getEntity();

            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }
}