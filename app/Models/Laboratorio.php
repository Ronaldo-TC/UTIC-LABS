<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Laboratorio extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'ubicacion'];

    public function computadoras(): HasMany
    {
        return $this->hasMany(Computadora::class);
    }
}
