<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class RegisterUser extends Authenticatable
{
    use HasFactory;
    protected $table = 'register_users';

    // protected $fillable = ['username' , 'first_name', 'last_name', 'email', 'password'];
    protected $fillable = ['username', 'first_name', 'last_name', 'email', 'password', 'theme'];

        protected $hidden = [
        'password',
    ];

}
