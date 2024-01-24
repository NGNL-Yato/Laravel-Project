<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    use HasFactory;

    protected $fillable = [
        'Numero_semestre',
        'id_module',
        'id_prof',
        'id_class',
    ];

    public function module()
    {
        return $this->belongsTo(Module::class, 'id_module');
    }

    public function professeur()
    {
        return $this->belongsTo(Professeur::class, 'id_prof');
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class, 'id_class');
    }
}
