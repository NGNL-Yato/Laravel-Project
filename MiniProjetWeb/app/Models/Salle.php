<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salle extends Model
{
    use HasFactory;
    protected $fillable = ['type_salle', 'nom_salle', 'id_departement'];
    // Relationship with Departement
    public function departement()
    {
        return $this->belongsTo(Departement::class, 'id_departement');
    }
    public function materiels()
    {
        return $this->hasMany(Materiel::class, 'id_salle');
    }
}
