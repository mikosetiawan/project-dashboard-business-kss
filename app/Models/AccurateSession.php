<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccurateSession extends Model
{
    //

    protected $fillable = [
        'session_id',
        'user_request',
        'accurate_host',
        'access_token',
        'created_at',
        'updated_at'
    ];
}
