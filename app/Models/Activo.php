<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Activo extends Model
{
    protected $fillable = [
        'codigo',
        'descrip',
        'precio',
        'fecha',
        'estado',
        'foto',
        'grupos_id',
        'oficinas_id',
        'responsables_id'
    ];

    protected $casts = [
        'fecha' => 'date',
        'precio' => 'decimal:2'
    ];

    // Relación con Grupo (singular)
    public function grupo(): BelongsTo
    {
        return $this->belongsTo(Grupo::class, 'grupos_id');
    }

    // Relación con Oficina (singular)
    public function oficina(): BelongsTo
    {
        return $this->belongsTo(Oficina::class, 'oficinas_id');
    }

    // Relación con Responsable (singular)
    public function responsable(): BelongsTo
    {
        return $this->belongsTo(Responsable::class, 'responsables_id');
    }
}
