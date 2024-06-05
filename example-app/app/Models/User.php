<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory,HasApiTokens,Notifiable;
    protected $table = 'User';
    protected $fillable = [
        'sdt',
        'password',
        'hovaten',
        'email',
        'diachi',
        'phanquyen',
        'avatar',
        'trangthai',
    ];
}
