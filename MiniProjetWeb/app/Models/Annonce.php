<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    protected $table = 'annonces';
    protected $attributes = [
        'id_class' => null, // default value
    ];
    
    protected $fillable = [
        'visibilite_annonce',
        'cible_annonce',
        'type_annonce',
        'titre_annonce',
        'contenu_annonce',
        'id_class',
        'id_user',
    ];

    public function classe()
    {
        return $this->belongsTo(Classe::class, 'id_class');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
