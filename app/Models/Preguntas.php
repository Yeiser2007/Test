<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preguntas extends Model
{
    /** @use HasFactory<\Database\Factories\PreguntasFactory> */
    use HasFactory;

    protected $fillable = [
        'description',
        'activo'
    ];
}
