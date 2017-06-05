<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Newlegal
 * @package App\Models
 * @version May 28, 2017, 6:29 pm UTC
 */
class Newlegal extends Model
{
    use SoftDeletes;

    public $table = 'newlegals';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'project_id',
        'operator_id',
        'area',
        'folder'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'project_id' => 'integer',
        'operator_id' => 'integer',
        'area' => 'string',
        'folder' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'area' => 'required',
        'folder' => 'required',
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

    public function scopeSearchByProject($query,$operator,$project,$area,$folder)
    {
        return $query->where(function($q) use($project,$operator,$area,$folder){
            $q->where('project_id',"=",$project);
            $q->where('operator_id',"=",$operator);
            $q->where('area',"=",$area);
            $q->where('folder',"=",$folder);
        });
    }
}
