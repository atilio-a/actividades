<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
          'first_name', 
          'last_name',
          'telefono',
          'email',
          'password',
          'entity_id',
          'rol',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function cuentas()
    {
        return $this->hasMany(UserCuenta::class);
    }

    public function cart()
    {
        return $this->belongsToMany(Product::class, 'user_cart')->withPivot('quantity');
    }

    public function getFullname()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function getAvatar()
    {
        return 'https://www.gravatar.com/avatar/'.md5($this->email);
    }
    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }
}
