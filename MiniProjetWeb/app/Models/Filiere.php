<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filiere extends Model
{
    use HasFactory;
    protected $fillable = ['nom_filiere', 'abreviation_nomfiliere', 'id_departement', 'id_formation', 'id_prof'];

    public function departement()
    {
        return $this->belongsTo(Departement::class, 'id_departement');
    }

    public function formation()
    {
        return $this->belongsTo(Formation::class, 'id_formation');
    }

    public function professeur()
    {
        return $this->belongsTo(Professeur::class, 'id_prof');
    }
}
