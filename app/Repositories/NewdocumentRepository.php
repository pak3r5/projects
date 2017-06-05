<?php

namespace App\Repositories;

use App\Models\Newdocument;
use InfyOm\Generator\Common\BaseRepository;

class NewdocumentRepository extends BaseRepository
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
        return Newdocument::class;
    }
}
