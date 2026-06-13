<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegProvince extends Model
{
    protected $table = 'reg_provinces';
    public $timestamps = false;

    public function regencies()
    {
        return $this->hasMany(RegRegency::class, 'province_id', 'id');
    }
}
