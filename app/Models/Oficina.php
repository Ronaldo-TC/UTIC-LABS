<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Oficina extends Model
{
    protected $fillable = ['nombre'];

    // Relación con Activos
    public function activos(): HasMany
    {
        return $this->hasMany(Activo::class, 'oficinas_id');
    }
}
