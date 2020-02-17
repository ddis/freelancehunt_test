<?php

namespace App\Services\FreelanceAPI;

use App\Services\FreelanceAPI\Exceptions\CurlError;
use App\Services\FreelanceAPI\Exceptions\JsonError;
use App\Services\FreelanceAPI\Mappers\BaseMapper;
use Curl\Curl;
use Kernel\App;
use stdClass;

/**
 * Class AbstractEntryPoint
 * @package App\Services\FreelanceAPI
 */
abstract class AbstractEntryPoint
{
    const BASE_PATH = "https://api.freelancehunt.com/v2/";

    protected $key    = null;
    protected $entity = null;
    /**
     * @var $mapper BaseMapper
     */
    protected $mapper = null;
    /**
     * @var $curl Curl
     */
    protected $curl = null;
    protected $url  = "";

    private $result = null;

    /**
     * AbstractEntryPoint constructor.
     * @throws \ErrorException
     */
    public function __construct()
    {
        $this->key = App::getInstance()->get("configManager")->get("API-key");
        $this->initCurl();
        $this->setMapper();
    }

    /**
     * @return AbstractEntity
     * @throws CurlError
     * @throws Exceptions\ClassNotExist
     * @throws JsonError
     */
    public function getEntity(): AbstractEntity
    {
        return $this->buildResponse()->result;
    }

    /**
     * @return EntityCollections
     * @throws CurlError
     * @throws Exceptions\ClassNotExist
     * @throws JsonError
     */
    public function getCollection(): EntityCollections
    {
        return $this->buildResponse()->result;
    }

    /**
     * @return BaseMapper
     */
    public function getMapper()
    {
        return $this->mapper;
    }

    /**
     * @return string
     * @throws CurlError
     */
    protected function getResponse()
    {
        $curl = $this->curl->get(self::BASE_PATH . "{$this->url}");

        if ($curl->getHttpStatus() !== 200) {
            throw new CurlError($curl->getErrorMessage(), $curl->getHttpStatus());
        }

        return $curl->getResponse();
    }


    /**
     * @return AbstractEntryPoint
     * @throws CurlError
     * @throws Exceptions\ClassNotExist
     * @throws JsonError
     */
    protected function buildResponse(): AbstractEntryPoint
    {
        $response = json_decode($this->getResponse());

        if (json_last_error()) {
            throw new JsonError();
        }

        if (is_array($response->data)) {

            $res = array_map(function ($item) {
                if (!$this->entity) {
                    $this->entity = EntityFactory::createInstance($item->type);
                }
                $entity = clone $this->entity;

                return $this->getMapper()->map($item, $entity);
            }, $response->data);

            $collection = new EntityCollections($res, $response->links ?? new StdClass());

            $this->result = $collection;
        } else {

            if (!$this->entity) {
                $this->entity = EntityFactory::createInstance($response->data->type);
            }

            $this->result = $this->getMapper()->map($response->data, $this->entity);
        }

        return $this;

    }

    /**
     *
     */
    protected function setMapper()
    {
        $this->mapper = new BaseMapper();
    }

    /**
     * @throws \ErrorException
     */
    private function initCurl()
    {
        $this->curl = new Curl();
        $this->curl->setHeader("Authorization", "Bearer {$this->key}");

        $this->curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
        $this->curl->setOpt(CURLOPT_SSL_VERIFYHOST, false);
    }

}