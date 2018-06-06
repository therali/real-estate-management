<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Locataire extends Model
{
    protected $fillable = [
        'prenom',
        'nom',
        'tel1',
        'tel2',
        'email',
        'adresse',
        'note',
    ];

    public function contrats() {
        return $this->hasMany( 'App\Contrat' );
    }

}
