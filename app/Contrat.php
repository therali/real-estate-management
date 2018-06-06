<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    protected $fillable = [
        'code',
        'date_in',
        'date_out',
        'depot_gar',
        'date_pay',
        'mode_pay',
        'loyer_nu',
        'periodicite',
        'etat',
        'note',
        'locataire_id',
        'local_id',
        'user_id',
    ];

    public function locataire() {
        return $this->belongsTo( 'App\Locataire' );
    }

    public function local() {
        return $this->belongsTo( 'App\Local' );
    }
    public function loyers() {
        return $this->hasMany( 'App\Loyer' );
    }

    public function user() {
        return $this->belongsTo( 'App\User' );
    }
}
