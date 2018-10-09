<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

use Spatie\Permission\Models\Role;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'id_estado', 'lastname'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    /**
     * Relacion de mcuhos a muchos de la tabla sedes
     */
    public function sedes()
    {
        return $this->belongsToMany(Sede::class, 'sedes_usuarios', 'fk_usuario', 'fk_sede');
    }
}
