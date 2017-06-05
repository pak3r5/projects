<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EstimateApiTest extends TestCase
{
    use MakeEstimateTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateEstimate()
    {
        $estimate = $this->fakeEstimateData();
        $this->json('POST', '/api/v1/estimates', $estimate);

        $this->assertApiResponse($estimate);
    }

    /**
     * @test
     */
    public function testReadEstimate()
    {
        $estimate = $this->makeEstimate();
        $this->json('GET', '/api/v1/estimates/'.$estimate->id);

        $this->assertApiResponse($estimate->toArray());
    }

    /**
     * @test
     */
    public function testUpdateEstimate()
    {
        $estimate = $this->makeEstimate();
        $editedEstimate = $this->fakeEstimateData();

        $this->json('PUT', '/api/v1/estimates/'.$estimate->id, $editedEstimate);

        $this->assertApiResponse($editedEstimate);
    }

    /**
     * @test
     */
    public function testDeleteEstimate()
    {
        $estimate = $this->makeEstimate();
        $this->json('DELETE', '/api/v1/estimates/'.$estimate->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/estimates/'.$estimate->id);

        $this->assertResponseStatus(404);
    }
}
