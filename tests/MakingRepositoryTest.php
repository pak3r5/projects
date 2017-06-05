<?php

use App\Models\Making;
use App\Repositories\MakingRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MakingRepositoryTest extends TestCase
{
    use MakeMakingTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var MakingRepository
     */
    protected $makingRepo;

    public function setUp()
    {
        parent::setUp();
        $this->makingRepo = App::make(MakingRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateMaking()
    {
        $making = $this->fakeMakingData();
        $createdMaking = $this->makingRepo->create($making);
        $createdMaking = $createdMaking->toArray();
        $this->assertArrayHasKey('id', $createdMaking);
        $this->assertNotNull($createdMaking['id'], 'Created Making must have id specified');
        $this->assertNotNull(Making::find($createdMaking['id']), 'Making with given id must be in DB');
        $this->assertModelData($making, $createdMaking);
    }

    /**
     * @test read
     */
    public function testReadMaking()
    {
        $making = $this->makeMaking();
        $dbMaking = $this->makingRepo->find($making->id);
        $dbMaking = $dbMaking->toArray();
        $this->assertModelData($making->toArray(), $dbMaking);
    }

    /**
     * @test update
     */
    public function testUpdateMaking()
    {
        $making = $this->makeMaking();
        $fakeMaking = $this->fakeMakingData();
        $updatedMaking = $this->makingRepo->update($fakeMaking, $making->id);
        $this->assertModelData($fakeMaking, $updatedMaking->toArray());
        $dbMaking = $this->makingRepo->find($making->id);
        $this->assertModelData($fakeMaking, $dbMaking->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteMaking()
    {
        $making = $this->makeMaking();
        $resp = $this->makingRepo->delete($making->id);
        $this->assertTrue($resp);
        $this->assertNull(Making::find($making->id), 'Making should not exist in DB');
    }
}
