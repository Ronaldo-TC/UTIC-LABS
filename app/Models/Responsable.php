<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Responsable extends Model
{
    protected $fillable = ['ci', 'nombre', 'foto'];

    // Relación con Activos
    public function activos(): HasMany
    {
        return $this->hasMany(Activo::class, 'responsables_id');
    }
}
