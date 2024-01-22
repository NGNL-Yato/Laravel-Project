<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;

    protected $fillable = ['nom_departement', 'id_prof'];
    
    public function professeur()
    {
        return $this->belongsTo(Professeur::class, 'id_prof');
    }
    public function chef()
    {
        return $this->belongsTo(Professeur::class, 'id_prof');
    }
}
