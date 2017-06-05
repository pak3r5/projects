<?php

use Faker\Factory as Faker;
use App\Models\Estimate;
use App\Repositories\EstimateRepository;

trait MakeEstimateTrait
{
    /**
     * Create fake instance of Estimate and save it in database
     *
     * @param array $estimateFields
     * @return Estimate
     */
    public function makeEstimate($estimateFields = [])
    {
        /** @var EstimateRepository $estimateRepo */
        $estimateRepo = App::make(EstimateRepository::class);
        $theme = $this->fakeEstimateData($estimateFields);
        return $estimateRepo->create($theme);
    }

    /**
     * Get fake instance of Estimate
     *
     * @param array $estimateFields
     * @return Estimate
     */
    public function fakeEstimate($estimateFields = [])
    {
        return new Estimate($this->fakeEstimateData($estimateFields));
    }

    /**
     * Get fake data of Estimate
     *
     * @param array $postFields
     * @return array
     */
    public function fakeEstimateData($estimateFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'operator_id' => $fake->randomDigitNotNull,
            'description' => $fake->word,
            'cost' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $estimateFields);
    }
}
