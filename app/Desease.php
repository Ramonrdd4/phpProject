<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Desease extends Model
{
    use SoftDeletes;

    public function expedientes()
    {
        return $this->hasMany('App\Expedientes');
    }
    protected $dates = ['deleted_at'];
}
