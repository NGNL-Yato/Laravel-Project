<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Etudiant extends Model
{
    use HasFactory;
    protected $table = 'etudiants';
    protected $primaryKey = 'id';
    protected $fillable = ['CNE', 'Nom', 'prenom', 'delegue', 'id_user', 'id_class'];
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function classe()
    {
        return $this->belongsTo(Classe::class, 'id_class');
    }
}

