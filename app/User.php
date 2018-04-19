<?php

namespace App;

use App\Permissions\HasPermissionsTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasPermissionsTrait;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'active', 'activation_token'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopeByEmail(Builder $builder, $email)
    {
        return $builder->where('email',$email);
    }

    public function scopeByActivationColumns(Builder $builder, $email, $token)
    {
        return $builder->where('email', $email)->where('activation_token', $token);
    }

    public function getFirstNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function getLastNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function getFullNameAttribute()
    {
        return "{$this->last_name} {$this->first_name}";
    }
}
