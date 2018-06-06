<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CordBanq extends Model
{
    protected $fillable = [
        'format',
        'titulaire',
        'num_compte',
        'name_banq',
        'iban',
        'bic_swift',
        'proprietaire_id',
    ];
}
