<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string
     */
    protected $fillable = [
        'libelle',
        'montant',
        'date_acq',
        'mode_pay',
        'result_comptable',
        'note',
        'type_charge_id',
        'local_id',
    ];
}
