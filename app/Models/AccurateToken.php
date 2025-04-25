<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccurateToken extends Model
{
    protected $fillable = [
        'access_token',
        'refresh_token',
        'expired_at',
        'scopes',
        'user_request'
    ];
}
