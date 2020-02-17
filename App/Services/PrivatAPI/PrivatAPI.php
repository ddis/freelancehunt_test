<?php

namespace App\Services\PrivatAPI;

use Curl\Curl;

/**
 * Class PrivatAPI
 * @package App\Services\PrivatAPI
 */
class PrivatAPI
{
    const URL = "https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5";

    private $curl = null;
    /**
     * @var string
     */
    private $course = [];

    private static $instance = null;

    /**
     * PrivatAPI constructor.
     * @throws \ErrorException
     */
    private function __construct()
    {
        $this->curl = new Curl();

        $this->initCourses();
    }

    /**
     *
     */
    private function __clone() { }

    /**
     * @return PrivatAPI|null
     * @throws \ErrorException
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @param float  $value
     * @param string $currency
     * @return float
     * @throws \Exception
     */
    public function convert(float $value, string $currency)
    {
        switch ($currency) {
            case "UAH";
                return $value;
                break;

            case "RUB";
                $currency = "RUR";
                break;
        }

        if (!isset($this->course[$currency])) {
            throw new \Exception("Undefined currency");
        }

        return round($value * $this->course[$currency], 2);
    }

    /**
     * Init courses method
     */
    private function initCourses()
    {
        $res = $this->curl->get(self::URL);

        if ($res->getHttpStatus() === 200) {
            foreach (json_decode($res->getResponse(), true) as $item) {
                $this->course[$item['ccy']] = $item['buy'];
            }
        }
    }
}