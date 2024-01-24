<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = ['nom_module', 'type_module', 'id_departement'];

    // Define any relationships here
    public function departement()
    {
        return $this->belongsTo(Departement::class, 'id_departement');
    }

}
