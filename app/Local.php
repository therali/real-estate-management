<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    protected $fillable = [
        'libelle', //Identification du local en complément de l’adresse. Par exemple : appartement 3G, maison, garage n°5...
        'adress',
        'meuble', //Location en meublé. Le logiciel utilise cette information pour la déclaration des revenus fonciers et pour la génération des contrats.
        'note',
        'surface',
        'nbpiece',
        'category_id',
        'consistance_id',
    ];

    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function mandats() {
        return $this->belongsTo('App\Mandat');
    }
}
