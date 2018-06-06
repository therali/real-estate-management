<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string
     */
    protected $fillable = [
        'namecat',
        'adresse',
        'ville',
        'note',
    ];

    public function locals() {
        return $this->hasMany('App\Local');
    }
}
