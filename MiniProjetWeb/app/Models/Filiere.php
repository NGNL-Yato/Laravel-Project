<?php

// app/Models/Filiere.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filiere extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_filiere',
        'abreviation_nomfiliere',
        'id_departement',
        'id_formation',
        'id_prof',
    ];

    // Ajoutez d'autres relations si nécessaire
}

