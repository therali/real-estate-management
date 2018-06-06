<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    protected $fillable = [
        'name',
        'adresse',
        'cp',
        'ville',
        'tel',
        'tel2',
        'info',
        'logo',
        'devise',
        'tva',
    ];
}
