<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    protected $table = 'demandes';

    protected $fillable = ['id_user', 'type_demande', 'contenu_demande', 'etat_demande', 'id_prof'];


    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function responses()
    {
        return $this->hasMany(Response::class);
    }
    public function professeur()
    {
        return $this->belongsTo(Professeur::class, 'id_prof');
    }
}
