<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamenesPreguntas extends Model
{
    /** @use HasFactory<\Database\Factories\ExamenesPreguntasFactory> */
    use HasFactory;
    
    protected $table = 'examenespreguntas';
    protected $fillable = [
        'id_pregunta',
        'id_exam',
        'activo',
    ];
    public function preguntas(){
        return $this->belongsTo(Preguntas::class, 'id_pregunta');
    }
}
