<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Project
 * @package App\Models
 * @version April 27, 2017, 11:08 pm UTC
 */
class Project extends Model
{

    public $table = 'projects';


    public $fillable = [
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name'=>'required'
    ];


    public function estimates()
    {
        return $this->hasMany(\App\Models\Estimate::class, 'estimate_id');
    }
}
