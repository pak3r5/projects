<?php

namespace App\Repositories;

use App\Models\Newlegal;
use InfyOm\Generator\Common\BaseRepository;

class NewlegalRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'area',
        'name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Newlegal::class;
    }
}
