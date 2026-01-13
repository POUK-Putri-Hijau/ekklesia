<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Account extends Authenticatable
{
    protected $table = 'accounts';
    public $incrementing = true;
    protected $keyType = 'integer';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];
}
