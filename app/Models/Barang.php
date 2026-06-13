<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    
    protected $fillable = [
        'name',
        'price',
        'brand',
        'badge',
        'type',
        'description',
        'image',
    ];

    protected $casts = [
        'price' => 'integer',
    ];
}