<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proprietaire extends Model
{
    protected $fillable = [
        'prenom',
        'nom',
        'tel1',
        'tel2',
        'email',
        'cp',
        'adresse',
        'ville',
        'note',
    ];

    public function mandats() {
        return $this->hasMany( 'App\Mandat' );
    }
}
