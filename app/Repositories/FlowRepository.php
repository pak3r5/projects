<?php

namespace App\Repositories;

use App\Models\Flow;
use InfyOm\Generator\Common\BaseRepository;

class FlowRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'type',
        'date',
        'amount',
        'area'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Flow::class;
    }
}
