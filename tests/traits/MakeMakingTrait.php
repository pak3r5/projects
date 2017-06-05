<?php

use Faker\Factory as Faker;
use App\Models\Making;
use App\Repositories\MakingRepository;

trait MakeMakingTrait
{
    /**
     * Create fake instance of Making and save it in database
     *
     * @param array $makingFields
     * @return Making
     */
    public function makeMaking($makingFields = [])
    {
        /** @var MakingRepository $makingRepo */
        $makingRepo = App::make(MakingRepository::class);
        $theme = $this->fakeMakingData($makingFields);
        return $makingRepo->create($theme);
    }

    /**
     * Get fake instance of Making
     *
     * @param array $makingFields
     * @return Making
     */
    public function fakeMaking($makingFields = [])
    {
        return new Making($this->fakeMakingData($makingFields));
    }

    /**
     * Get fake data of Making
     *
     * @param array $postFields
     * @return array
     */
    public function fakeMakingData($makingFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $makingFields);
    }
}
