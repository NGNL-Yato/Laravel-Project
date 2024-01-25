<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sceance extends Model
{
    use HasFactory;
    protected $table = 'sceances';
    protected $fillable = [
        'etat_sceance',
        'type_sceance',
        'horaire',
        'jour',
        'semaine',
        'mois',
        'annee',
        'id_class',
        'id_cours',
        'id_salle',
    ];
    public function classe()
    {
        return $this->belongsTo(Classe::class, 'id_class');
    }

    public function module()
    {
        return $this->belongsTo(Module::class, 'id_module');
    }
    public function salle()
    {
        return $this->belongsTo(Salle::class, 'id_salle');
    }
}
