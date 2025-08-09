<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'last_login',
    ];

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
            'last_login' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Vérifier si l'utilisateur est un administrateur
     */
    public function isAdmin(): bool
    {
        return in_array($this->role, ['admin', 'main_admin']);
    }

    /**
     * Vérifier si l'utilisateur est l'administrateur principal
     */
    public function isMainAdmin(): bool
    {
        return $this->role === 'main_admin';
    }

    /**
     * Obtenir le nom du rôle formaté
     */
    public function getRoleNameAttribute(): string
    {
        return match($this->role) {
            'main_admin' => 'Administrateur Principal',
            'admin' => 'Administrateur',
            'user' => 'Utilisateur',
            default => 'Utilisateur'
        };
    }
}
