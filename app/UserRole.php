<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $fillable = [
        'user_id',
        'menu_id',
    ];

    public function user() {
        return $this->belongsTo( 'App\User' );
    }

    public function menu() {
        return $this->belongsTo( 'App\Menu' );
    }

}
