<?php

// app/Models/Annonce.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    use HasFactory;

    protected $table = 'annonces'; // Assurez-vous que le nom de votre table est correct
    protected $primaryKey = 'id'; // Assurez-vous que le nom de votre clé primaire est correct

    protected $fillable = [
        'visibilite_annonce',
        'cible_annonce',
        'type_annonce',
        'titre_annonce',
        'date_creation',
        'date_modification',
        'contenu_annonce',
        'id_class',
        'id_user',
        // Vous pouvez ajouter d'autres colonnes ici
    ];

    // Vous pouvez définir des relations, des accesseurs, des mutateurs, etc.

    // Exemple de scope pour récupérer les annonces publiques triées par date décroissante
    public function scopePublicSortedByDate($query)
    {
        return $query->where('visibilite_annonce', 'public')
            ->orderByDesc('date_creation');
    }
}

