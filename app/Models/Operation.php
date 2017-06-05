<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Operation
 * @package App\Models
 * @version May 29, 2017, 1:34 am UTC
 */
class Operation extends Model
{
    use SoftDeletes;

    public $table = 'operations';

    protected $dateFormat = 'd-m-y';

    protected $dates = ['deleted_at'];


    public $fillable = [
        'project_id',
        'operator_id',
        'type',
        'amount',
        'date',
        'status',
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
        'amount' => 'string',
        'date' => 'date',
        'status' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'project_id' => 'required',
        'operator_id' => 'required',
        'type' => 'required',
        'amount' => 'required',
        'date' => 'required',
        'status' => 'required',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function projects()
    {
        return $this->hasMany(\App\Models\Project::class, 'project_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function operators()
    {
        return $this->hasMany(\App\Models\Operator::class, 'operator_id');
    }

    public function scopeSearchByProject($query,$operator,$project,$folder,$status)
    {
        return $query->where(function($q) use($project,$operator,$folder,$status){
            $q->where('project_id',"=",$project);
            $q->where('operator_id',"=",$operator);
            $q->where('type',"=",$folder);
            $q->where('status',"=",$status);
        });
    }

    public function scopeAccount($query,$operator,$project,$folder,$status)
    {
        return $query->where(function($q) use($project,$operator,$folder,$status){
            $q->where('project_id',"=",$project);
            $q->where('operator_id',"=",$operator);
            $q->where('type',"=",$folder);
            $q->where('status',"=",$status);
        });
    }

    public function scopeGetMove($query,$operator,$project,$folder)
    {
        return $query->where(function($q) use($project,$operator,$folder){
            $q->where('project_id',"=",$project);
            $q->where('operator_id',"=",$operator);
            $q->where('type',"=",$folder);
        });
    }
}
