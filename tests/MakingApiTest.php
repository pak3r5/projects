<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MakingApiTest extends TestCase
{
    use MakeMakingTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateMaking()
    {
        $making = $this->fakeMakingData();
        $this->json('POST', '/api/v1/makings', $making);

        $this->assertApiResponse($making);
    }

    /**
     * @test
     */
    public function testReadMaking()
    {
        $making = $this->makeMaking();
        $this->json('GET', '/api/v1/makings/'.$making->id);

        $this->assertApiResponse($making->toArray());
    }

    /**
     * @test
     */
    public function testUpdateMaking()
    {
        $making = $this->makeMaking();
        $editedMaking = $this->fakeMakingData();

        $this->json('PUT', '/api/v1/makings/'.$making->id, $editedMaking);

        $this->assertApiResponse($editedMaking);
    }

    /**
     * @test
     */
    public function testDeleteMaking()
    {
        $making = $this->makeMaking();
        $this->json('DELETE', '/api/v1/makings/'.$making->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/makings/'.$making->id);

        $this->assertResponseStatus(404);
    }
}
