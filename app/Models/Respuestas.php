<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respuestas extends Model
{
    /** @use HasFactory<\Database\Factories\RespuestasFactory> */
    use HasFactory;
    protected $fillable = [
        'id_pregunta',
        'activo',
        'description',
        'correcta',
    ];
}
