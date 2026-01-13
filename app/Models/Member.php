<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'members';
    public $incrementing = true;
    protected $keyType = 'integer';

    protected $fillable = [
        'name',
        'birth_date',
        'address',
        'family_id',
    ];
}
