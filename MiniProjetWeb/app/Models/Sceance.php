<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sceance extends Model
{
    protected $table = 'sceances';

    protected $fillable = [
        'etat_sceance',
        'type_sceance',
        'id_class',
        'id_module',
        'mois',
        'semaine',
        'id_horaire',
        'id_jour',
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

    public function horaire()
    {
        return $this->belongsTo(Horaire::class, 'id_horaire');
    }

    public function jour()
    {
        return $this->belongsTo(Jour::class, 'id_jour');
    }

    public function salle()
    {
        return $this->belongsTo(Salle::class, 'id_salle');
    }
}
