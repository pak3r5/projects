<?php

namespace App;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Addres extends Model
{
    public $table = "adresses";

    public $primaryKey = "id";

    public $fillable = [
        "col",
        "typeofcol",
        "mun",
        "state",
        "city",
        "cp"
    ];

    public static $rules = [
        "col"=>"required",
        "typeofcol" => "required",
        "mun" => "required",
        "state" => "required",
        "city" => "required",
        "cp" => "required|numeric",
    ];

    public function scopeGetCol($query,$cp) {
        $query=Addres::where($cp)->select('col')->orderBy('col', 'asc')->get();
        return $query;
    }

    public function scopeGetGeneralInformation($query,$cp) {
        $query=Addres::where($cp)->select('mun','state','city')->distinct()->get();
        return $query;
    }
}
