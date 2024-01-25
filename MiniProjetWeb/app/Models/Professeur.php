<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professeur extends Model
{
    use HasFactory;
    protected $fillable = ['Code_prof', 'nom', 'prenom', 'id_user'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function departement()
    {
        return $this->hasOne(Departement::class, 'id_prof');
    }
    public function filiere()
    {
        return $this->hasOne(Filiere::class, 'id_prof');
    }
    public function cours()
    {
        return $this->hasMany(Cours::class, 'id_prof');
    }
    
}
