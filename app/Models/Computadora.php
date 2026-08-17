<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Computadora extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'laboratorio_id',
        'codigo_inventario',
        'marca',
        'procesador',
        'ram_gb',
        'estado'
    ];

    protected $casts = [
        'ram_gb' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function laboratorio(): BelongsTo
    {
        return $this->belongsTo(Laboratorio::class);
    }

    // Scope para filtrar por marca
    public function scopeByMarca($query, $marca)
    {
        if ($marca) {
            return $query->where('marca', 'LIKE', "%{$marca}%");
        }
        return $query;
    }
}
