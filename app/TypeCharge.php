<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeCharge extends Model
{
    protected $fillable = [
        'libelle',
        'deductible',
    ];
}
