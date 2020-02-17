<?php

class EntryPointTest extends Codeception\Test\Unit
{

    protected $projectInstance    = null;
    protected $freelancerInstance = null;

    /**
     * @throws Exception
     */
    protected function _before()
    {
        $projectMockPath    = TEST_CORE_PATH . "/_data/Services/FreelanceAPI/EntryPoints/projectsMock.json";
        $freelancerMockPath = TEST_CORE_PATH . "/_data/Services/FreelanceAPI/EntryPoints/freelancerMock.json";

        $this->projectInstance = $this->make(\App\Services\FreelanceAPI\EntryPoints\Projects::class, [
            'getResponse' => file_get_contents($projectMockPath),
            'getMapper'   => new \App\Services\FreelanceAPI\Mappers\BaseMapper(),
        ]);

        $this->freelancerInstance = $this->make(\App\Services\FreelanceAPI\EntryPoints\MyProfile::class, [
            'getResponse' => file_get_contents($freelancerMockPath),
            'getMapper'   => new \App\Services\FreelanceAPI\Mappers\BaseMapper(),
        ]);
    }

    /**
     * @throws Exception
     */
    public function testGetCollection()
    {
        $collection = $this->projectInstance->getCollection();

        $this->assertInstanceOf(\App\Services\FreelanceAPI\EntityCollections::class, $collection);
        $this->assertIsArray($collection->toArray());
        $this->assertCount(10, $collection->toArray());

        foreach ($collection as $item) {
            $this->assertInstanceOf(\App\Services\FreelanceAPI\Entities\Project::class, $item);

            $arrayItem = $item->toArray();

            $this->assertIsArray($arrayItem);
            $this->assertCount(10, $arrayItem);

            $this->assertIsArray($arrayItem['skills']);
            $this->assertIsArray($arrayItem['employer']);

            $this->assertIsInt($arrayItem['id']);
        }
    }

    public function testGetEntity()
    {
        $entity      = $this->freelancerInstance->getEntity();
        $entityArray = $entity->toArray();

        $this->assertInstanceOf(\App\Services\FreelanceAPI\Entities\Freelancer::class, $entity);
        $this->assertIsArray($entity->toArray());
        $this->assertCount(5, $entityArray);

        $this->assertIsInt($entity->id);
        $this->assertIsInt($entityArray['id']);
        $this->assertIsArray($entityArray['small_avatar']);
        $this->assertCount(3, $entityArray['small_avatar']);
    }
}