<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Contact
 * @package App\Models
 * @version May 5, 2017, 4:43 am UTC
 */
class Contact extends Model
{
    public $table = 'contacts';

    public $fillable = [
        'name',
        'job',
        'email',
        'phone',
        'operator_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'job' => 'string',
        'email' => 'string',
        'phone' => 'string',
        'operator_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'job' => 'required',
        'email' => 'required',
        'phone' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function operator()
    {
        return $this->belongsTo(\App\Models\Operator::class, 'operator_id', 'id');
    }
}
