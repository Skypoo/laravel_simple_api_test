<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'user';
//    public $timestamps = false;
    protected $fillable = [
        'account',
        'password'
    ];
}
