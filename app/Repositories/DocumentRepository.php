<?php

namespace App\Repositories;

use App\Models\Document;
use InfyOm\Generator\Common\BaseRepository;

class DocumentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'area',
        'subarea'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Document::class;
    }
}
