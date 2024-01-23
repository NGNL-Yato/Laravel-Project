<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materiel extends Model
{
    use HasFactory;

    protected $fillable = ['type_materiel', 'etat_materiel', 'id_class'];

    public function classe()
    {
        return $this->belongsTo(Classe::class, 'id_class');
    }
}
