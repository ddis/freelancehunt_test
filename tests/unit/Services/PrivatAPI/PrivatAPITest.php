<?php

class PrivatAPITest extends Codeception\Test\Unit
{
    /**
     * @var $instance \App\Services\PrivatAPI\PrivatAPI
     */
    protected $instance = null;

    /**
     * @throws Exception
     */
    protected function _before()
    {
        $course = json_decode(file_get_contents(TEST_CORE_PATH . "/_data/Services/PrivatAPI/mockData.json"), true);

        $this->instance = $this->make(\App\Services\PrivatAPI\PrivatAPI::class, [
            "course" => $course,
        ]);
    }

    /**
     * @throws Exception
     */
    public function testAction()
    {
        $this->assertEquals(2, $this->instance->convert(2, "UAH"));
        $this->assertEquals(352, $this->instance->convert(1000, "RUB"));
        $this->assertEquals(2429, $this->instance->convert(100, "USD"));
        $this->assertEquals(2624, $this->instance->convert(100, "EUR"));
    }
}