<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loyer extends Model {
    protected $fillable = [
        'code',
        'libelle',
        'dd',
        'df',
        'montant',
        'echeance',
        'msg_quittance',
        'note',
        'contrat_id',
        'user_id',
    ];

    public function contrat() {
        return $this->belongsTo( 'App\Contrat' );
    }

    public function user() {
        return $this->belongsTo( 'App\User' );
    }

    public function paiements() {
        return $this->hasMany( 'App\Paiement' );
    }

    public function getEtatLoyer() {
        $somme = Paiement::where( 'loyer_id', $this->id )->sum( 'montant' );
        if ( $somme == $this->montant ) {
            return 1;
        } elseif ( $somme > 0 AND $somme < $this->montant ) {
            return 2;
        } elseif ( $somme > $this->montant ) {
            return 3;
        }
        return 0;
    }

}
