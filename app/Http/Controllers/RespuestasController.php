<?php

namespace App\Http\Controllers;

use App\Models\Preguntas;
use App\Models\Respuestas;
use App\Http\Requests\StoreRespuestasRequest;
use App\Http\Requests\UpdateRespuestasRequest;
use Illuminate\Http\Request;

class RespuestasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            $respuestas = Respuestas::query()
                ->latest()
                ->paginate(5);
            return response()->json([
                'success' => true,
                'data' => $respuestas->items(),
                'current_page' => $respuestas->currentPage(),
                'last_page' => $respuestas->lastPage(),
                'per_page' => $respuestas->perPage(),
                'total' => $respuestas->total()
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
       public function create()
    {
        return view('respuestas.create');
    }
    public function createById($id)
    {
        $pregunta = Preguntas::find($id);
        $preguntaId = $pregunta->id;
        return view('respuestas.create',compact('preguntaId'));
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(StoreRespuestasRequest $request)
    {
        if ($request->wantsJson()) {
            $respuestas = Respuestas::create($request->all());
            return response()->json([
                'success' => true,
                'message' => 'Respuesta creada exitosamente',
                'data' => $respuestas
            ], 201);
        }
        return view('preguntas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pregunta = Preguntas::find($id);
        return view('respuestas.index',compact('pregunta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Respuestas $respuestas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRespuestasRequest $request, Respuestas $respuestas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $respuestas = Respuestas::find($id);
        $respuestas->delete();
        return response()->json([
            'success' => true,
            'message' => 'Respuesta eliminada exitosamente',
        ]);
    }
}
