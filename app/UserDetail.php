<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'avatar', 'state', 'postcode',
    ];

    /**
     * Setting relationship with parent table Users
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
