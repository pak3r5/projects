<?php

namespace App\Repositories;

use App\Models\Operator;
use InfyOm\Generator\Common\BaseRepository;

class OperatorRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'rfc',
        'name',
        'type'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Operator::class;
    }
    
}
