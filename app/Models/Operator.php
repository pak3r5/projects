<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Operator
 * @package App\Models
 * @version May 5, 2017, 2:49 am UTC
 */
class Operator extends Model
{

    public $table = 'operators';

    public $fillable = [
        'name',
        'type',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'type' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'type' => 'required',
    ];

    public function contacts()
    {
        return $this->hasMany('App\Contact');
    }

    public function scopeSearch($query,$search)
    {
        if(trim($search)!=""){
            return $query->orWhere(function($query) use ($search)
            {
                $query->where('name', 'LIKE', "%$search%")->orWhere('type', 'LIKE', "%$search%");
            });
        }
    }

    public function scopeByType($query,$search)
    {
        if(trim($search)!=""){
            return $query->orWhere(function($query) use ($search)
            {
                $query->Where('type', '=', $search);
            });
        }
    }
}
