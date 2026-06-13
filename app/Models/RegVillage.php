<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegVillage extends Model
{
    protected $table = 'reg_villages';
    public $timestamps = false;

    public function district()
    {
        return $this->belongsTo(RegDistrict::class, 'district_id', 'id');
    }
}
