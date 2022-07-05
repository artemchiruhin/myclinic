<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = ['first_name','last_name','patronymic',
        'email','password','phone','role'];
    protected $hidden = ['password',];
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }
    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = upper_first(mb_strtolower($value));
    }
    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = upper_first(mb_strtolower($value));
    }
    public function setPatronymicAttribute($value)
    {
        $this->attributes['patronymic'] = upper_first(mb_strtolower($value));
    }
}
