<?php

namespace App\Repositories;

use App\Models\Legal;
use InfyOm\Generator\Common\BaseRepository;

class LegalRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'area',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Legal::class;
    }
}
