<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    protected $fillable = [
        'montant',
        'date_pay',
        'mode_pay',
        'payer_par',
        'loyer_id',
    ];

    public function loyer() {
        return $this->belongsTo( 'App\Loyer' );
    }
}
