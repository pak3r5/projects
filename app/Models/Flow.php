<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Flow
 * @package App\Models
 * @version May 13, 2017, 7:54 pm UTC
 */
class Flow extends Model
{
    use SoftDeletes;

    public $table = 'flows';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'project_id',
        'operator_id',
        'type',
        'date',
        'amount',
        'area',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'project_id' => 'integer',
        'operator_id' => 'integer',
        'type' => 'string',
        'date' => 'date',
        'amount' => 'string',
        'area' => 'string',
        'rate' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'type' => 'required',
        'project_id' => 'required',
        'operator_id' => 'required',
        'date' => 'required',
        'amount' => 'required',
        'area' => 'required',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function projects()
    {
        return $this->hasMany(\App\Models\Project::class, 'project_id');
    }

    public function files()
    {
        return $this->morphMany(\App\Models\File::class, 'filetable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function operators()
    {
        return $this->hasMany(\App\Models\Operator::class, 'operator_id');
    }
}
