<?php

namespace App\Http\Controllers;

use App\Models\Preguntas;
use App\Http\Requests\StorePreguntasRequest;
use App\Http\Requests\UpdatePreguntasRequest;
use Illuminate\Http\Request;

class PreguntasController extends Controller
{
    
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            $preguntas = Preguntas::query()
                ->latest()
                ->paginate(5);
            return response()->json([
                'success' => true,
                'data' => $preguntas->items(),
                'current_page' => $preguntas->currentPage(),
                'last_page' => $preguntas->lastPage(),
                'per_page' => $preguntas->perPage(),
                'total' => $preguntas->total()
            ]);
        }
        return view('preguntas.index');
    }

    public function create()
    {
        return view('preguntas.create');
    }

     public function store(StorePreguntasRequest $request)
    {
        if ($request->wantsJson()) {
            $preguntas = Preguntas::create($request->all());
            return response()->json([
                'success' => true,
                'message' => 'Pregunta creada exitosamente',
                'data' => $preguntas
            ], 201);
        }
        return view('preguntas.index');
    }

    public function show($id)
    {
        $pregunta = Preguntas::find($id);
        return view('respuestas.index',compact('pregunta'));

    }

    public function edit(Preguntas $preguntas)
    {
        //
    }

    public function update(UpdatePreguntasRequest $request, Preguntas $preguntas)
    {
        //
    }

    public function destroy(Preguntas $preguntas)
    {
        //
    }
}
