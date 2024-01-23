<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;

    protected $fillable = ['id_filiere','Numero_groupe'];

    public function filiere()
    {
        return $this->belongsTo(Filiere::class, 'id_filiere');
    }
    public function etudiants()
    {
        return $this->hasMany(Etudiant::class, 'id_class');
    }

    public function materiels()
    {
        return $this->hasMany(Materiel::class, 'id_class');
    }
}
