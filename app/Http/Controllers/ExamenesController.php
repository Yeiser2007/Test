<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Http\Requests\StoreExamRequest;
use App\Http\Requests\UpdateExamRequest;
use App\Models\ExamenesPreguntas;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use App\Models\examenes;

class ExamenesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            $examenes = Examenes::with('user')
                ->latest()
                ->paginate(5);

            return response()->json([
                'success' => true,
                'data' => $examenes->items(),
                'current_page' => $examenes->currentPage(),
                'last_page' => $examenes->lastPage(),
                'per_page' => $examenes->perPage(),
                'total' => $examenes->total()
            ]);
        }

        return view('examenes.index');


    }
    public function create()
    {
        $user = auth()->user();
        return view('examenes.create', compact('user'));
    }

    public function store(StoreExamRequest $request)
    {
        if ($request->wantsJson()) {
            $id = auth()->user()->id;
            $request['id_usuario'] = $id;
            $examenes = Examenes::create($request->all());
            return response()->json([
                'success' => true,
                'message' => 'Examen creado exitosamente',
                'data' => $examenes
            ], 201);
        }
        return view('examenes.index');
    }

    public function show($id)
    {
        $examen = ExamenesPreguntas::where('id_exam', $id)->get()->first();
        return view('examenes.show', compact('examen'));

    }
    public function getDataOfExam(Request $request, $id){
        if($request->wantsJson()){
            $examen = ExamenesPreguntas::where('id_exam', $id)->with('preguntas')->get()->first();
            return response()->json([
                'success' => true,
                'data'=> $examen
            ]);
        }

    }

    public function edit(Examenes $exam)
    {
        //
    }

    public function update(UpdateExamRequest $request, Examenes $exam)
    {
        //
    }

        public function destroy($id)
    {
        $respuestas = Examenes::find($id);
        $respuestas->delete();
        return response()->json([
            'success' => true,
            'message' => 'Respuesta eliminada exitosamente',
        ]);
    }
}
