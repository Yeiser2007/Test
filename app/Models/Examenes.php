<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examenes extends Model
{
    /** @use HasFactory<\Database\Factories\ExamFactory> */
    use HasFactory;
      protected $fillable = [
        'id_usuario',
        'numero_preguntas'
    ];
    public function preguntas()
    {
        return $this->hasMany(Preguntas::class);
    }
    public function user()
    {
      return $this->belongsTo(User::class,'id_usuario');
    }
}
