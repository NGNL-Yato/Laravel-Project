<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];
    public function etudiants()
    {
        return $this->hasMany(Etudiant::class);
    }

    public function professeurs()
    {
        return $this->hasMany(Professeur::class);
    }

    public function annonces()
    {
        return $this->hasMany(Annonce::class);
    }

    public function demandes()
    {
        return $this->hasMany(Demande::class);
    }

    // If applicable
    public function responsableServicePedagogique()
    {
        return $this->hasOne(ResponsableServicePedagogique::class);
    }

    // ...
}
Classe Model:

Belongs to Filiere.
Has many Cours, Etudiants, Sceances, Materiels, and Annonces.
php
Copy code
class Classe extends Model
{
    // ...

    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }

    public function cours()
    {
        return $this->hasMany(Cours::class);
    }

    public function etudiants()
    {
        return $this->hasMany(Etudiant::class);
    }

    public function sceances()
    {
        return $this->hasMany(Sceance::class);
    }

    public function materiels()
    {
        return $this->hasMany(Materiel::class);
    }

    public function annonces()
    {
        return $this->hasMany(Annonce::class);
    }
    // defining the relations

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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
