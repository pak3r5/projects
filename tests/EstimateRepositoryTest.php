<?php

use App\Models\Estimate;
use App\Repositories\EstimateRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EstimateRepositoryTest extends TestCase
{
    use MakeEstimateTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var EstimateRepository
     */
    protected $estimateRepo;

    public function setUp()
    {
        parent::setUp();
        $this->estimateRepo = App::make(EstimateRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateEstimate()
    {
        $estimate = $this->fakeEstimateData();
        $createdEstimate = $this->estimateRepo->create($estimate);
        $createdEstimate = $createdEstimate->toArray();
        $this->assertArrayHasKey('id', $createdEstimate);
        $this->assertNotNull($createdEstimate['id'], 'Created Estimate must have id specified');
        $this->assertNotNull(Estimate::find($createdEstimate['id']), 'Estimate with given id must be in DB');
        $this->assertModelData($estimate, $createdEstimate);
    }

    /**
     * @test read
     */
    public function testReadEstimate()
    {
        $estimate = $this->makeEstimate();
        $dbEstimate = $this->estimateRepo->find($estimate->id);
        $dbEstimate = $dbEstimate->toArray();
        $this->assertModelData($estimate->toArray(), $dbEstimate);
    }

    /**
     * @test update
     */
    public function testUpdateEstimate()
    {
        $estimate = $this->makeEstimate();
        $fakeEstimate = $this->fakeEstimateData();
        $updatedEstimate = $this->estimateRepo->update($fakeEstimate, $estimate->id);
        $this->assertModelData($fakeEstimate, $updatedEstimate->toArray());
        $dbEstimate = $this->estimateRepo->find($estimate->id);
        $this->assertModelData($fakeEstimate, $dbEstimate->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteEstimate()
    {
        $estimate = $this->makeEstimate();
        $resp = $this->estimateRepo->delete($estimate->id);
        $this->assertTrue($resp);
        $this->assertNull(Estimate::find($estimate->id), 'Estimate should not exist in DB');
    }
}
