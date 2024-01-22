<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DescriptionFormation extends Model
{
    use HasFactory;
    protected $fillable = [
        'objectif_text',
        'competence_debouche',
        'id_filiere',
    ];

    public function filiere()
    {
        return $this->belongsTo(Filiere::class, 'id_filiere');
    }
}
