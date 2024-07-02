<?php

namespace App\Http\Controllers;

use App\Models\Estudiantes;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\HttpCache\Esi;

class EstudiantesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Estudiantes::query();

        if ($request->has('nombre')) {
            $query->where('nombre', 'like', '%' . $request->nombre . '%');
        }

        if ($request->has('apellido')) {
            $query->where('apellido', 'like', '%' . $request->apellido . "%");
        }

        $estudiantes = $query->orderBy('id', 'desc')->simplePaginate(10);
        return view('estudiantes.index', compact('estudiantes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('estudiantes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $estudiante = Estudiantes::create($request->all());
        return redirect()->route('estudiantes.index')->with('succes', 'Estudiante creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $estudiante = Estudiantes::find($id);

        if(!$estudiante) {
            return abort(404);
        }
        return view('estudiantes.show', compact('estudiante'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $estudiante = Estudiantes::find($id);

        if(!$estudiante){
            return abort(404);
        }
        return view('estudiantes.edit', compact('estudiante'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $estudiante = Estudiantes::find($id);
        if(!$estudiante){
            return abort(404);
        }
        $estudiante->nombre = $request->nombre;
        $estudiante->apellido = $request->apellido;
        $estudiante->email = $request->email;
        $estudiante->save();
        return redirect()->route('estudiantes.index')->with('succes', 'Estudiante actualizado correctamente');
    }

    public function delete($id){
        $estudiante = Estudiantes::find($id);
        if(!$estudiante){
            return abort(404);
        }
        return view('estudiantes.delete', compact('estudiante'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $estudiante = Estudiantes::find($id);

        if(!$estudiante){
            return abort(404);
        }
        $estudiante->delete();
        return redirect()->route('estudiantes.index')->with('success', 'Estudiante eliminado correctamnte');
    }
}
