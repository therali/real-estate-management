<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mandat extends Model
{
    protected $fillable = [
        'dd',
        'df',
        'loyer_nu',
        'periodicite',
        'etat',
        'charge_ded',
        'note',
        'local_id',
        'proprietaire_id',
        'user_id',
    ];

    public function proprietaire() {
        return $this->belongsTo( 'App\Proprietaire' );
    }

    public function local() {
        return $this->belongsTo( 'App\Local' );
    }

    public function user() {
        return $this->belongsTo( 'App\User' );
    }
}
