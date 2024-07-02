<?php

namespace App\Http\Controllers;

use App\Models\EstudiantesGrupo;
use Illuminate\Http\Request;

use App\Models\Estudiantes;
use App\Models\Grupo;
use GuzzleHttp\Psr7\Query;

class EstudiantesGrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = EstudiantesGrupo::query();

        if($request->has('estudiante_id') && is_numeric($request->estudiante_id)){
            $query->where('estudiante_id', '=', $request->estudiante_id);
        }
        $estudiantesGrupo = $query->with('estudiante', 'grupo')
            ->orderBy('id', 'desc')
            ->simplePaginate(10);
        $estudiantesGrupos = $query->orderBy('id', 'desc')->simplePaginate(10);
        $estudiantes = Estudiantes::all();
        return view('estudiantes_grupos.index', compact('estudiantesGrupos', 'estudiantes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $estudiantes = Estudiantes::all();
        $grupos = Grupo::all();
        return view ('estudiantes_grupos.create', compact('estudiantes', 'grupos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $estudiantes = Estudiantes::create($request->all());
        return redirect()->route('estudiantes_grupos.index')->with('success', 'EstudianteGrupo creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $estudiantesGrupo = EstudiantesGrupo::find($id);

        if(!$estudiantesGrupo){
            return abort(404);
        }
        return view('estudiantes_grupos.show', compact('estudiantesGrupo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $estudiantesGrupo = EstudiantesGrupo::find($id);
        if(!$estudiantesGrupo){
            return abort(404);
        }
        $estudiantes = Estudiantes::all();
        $grupos = Grupo::all();
        return view('estudiantes_grupo.edit', compact('estudianteGrupo', 'estudiantes', 'grupos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $estudiantesGrupo = EstudiantesGrupo::find($id);
        if(!$estudiantesGrupo){
            return abort(404);
        }
        $estudiantesGrupo->estudiante_id = $request->estudiante_id;
        $estudiantesGrupo->grupo_id = $request->grupo_id;
        $estudiantesGrupo->save();

        return redirect()->route('estudiantes_grupos.index')->with('success', 'EstudianteGrupo actualizado correctamente');
    }

    public function delete($id)
    {
        $estudiantesGrupo = EstudiantesGrupo::find($id);
        if(!$estudiantesGrupo){
            return abort(404);
        }
        return view('estudiantes_grupo.delete', compact('estudianteGrupo'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $estudiantesGrupo = EstudiantesGrupo::find($id);
        if(!$estudiantesGrupo){
            return abort(404);
        }
        $estudiantesGrupo->delete();
        return redirect()->route('estudiantes_grupo.index')->with('success', 'EstudianteGrupo eliminado correctamente');
    }
}
