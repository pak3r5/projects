<?php

namespace App\Repositories;

use App\Models\Estimate;
use InfyOm\Generator\Common\BaseRepository;

class EstimateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Estimate::class;
    }
}
