<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Grupo extends Model
{
    protected $fillable = ['descrip', 'vidautil'];

    // Relación con Activos
    public function activos(): HasMany
    {
        return $this->hasMany(Activo::class, 'grupos_id');
    }
}
