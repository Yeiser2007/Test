<?php

namespace App\Http\Controllers;

use App\Models\Examenes;
use App\Models\ExamenesPreguntas;
use App\Http\Requests\StoreExamenesPreguntasRequest;
use App\Http\Requests\UpdateExamenesPreguntasRequest;
use App\Models\Preguntas;
use Illuminate\Http\Request;

class ExamenesPreguntasController extends Controller
{

    public function index(Request $request)
    {
        if($request->wantsJson()){
            $examen = ExamenesPreguntas::all();
            return response()->json([
                'success' => true,
                'data' => $examen
            ]);
        }
        return view('examenes.show');
    }
    public function preguntasAleatorias()
    {
        $preguntas = Preguntas::inRandomOrder()->limit(5)->get();
        return $preguntas;
    }

    public function random(Request $request)
    {
        if ($request->wantsJson()) {
            $preguntas = $this->preguntasAleatorias();
            $length = $preguntas->count();

            $exam = Examenes::create([
                'id_usuario' => $request->id_usuario,
                'descripcion' => $request->descripcion,
                'numero_preguntas' => $length,
            ]);
            foreach ($preguntas as $pregunta) {
                ExamenesPreguntas::create([
                    'id_pregunta' => $pregunta->id,
                    'id_exam' => $exam->id,
                ]);
            }
        }
        return view('examenes.index');
    }
}
