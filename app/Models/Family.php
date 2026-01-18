<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    protected $table = 'families';
    public $incrementing = true;
    protected $keyType = 'integer';

    protected $fillable = [
        'name',
        'address',
        'wedding_date',
    ];
}
