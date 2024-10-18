<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'estatus_id',
        'rol_id',
        'alta_usuario',
        'nombres',
        'apellido_paterno',
        'apellido_materno',
        'matricula',
        'email',
        'password',
        'url_foto',
    ];

    public function rol()
    {
        return $this->hasOne(Rol::class, 'id', 'rol_id');
    }

    public function estatus()
    {
        return $this->hasOne(Estatus::class, 'id', 'estatus_id');
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
