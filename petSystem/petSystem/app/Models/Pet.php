<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $fillable = [
        'pet_id',
        'name',
        'species',
        'status',
    ];
}
