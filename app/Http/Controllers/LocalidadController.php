<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Localidad;
use App\Models\Departamento;

class LocalidadController extends Controller
{
    public function index()
    {
        $localidades = Localidad::with('departamento')->get();
        return view('localidades.index', compact('localidades'));
    
    }
      // Mostrar el formulario para crear una nueva localidad
    public function create()
    {
           // Cargar todos los departamentos desde la base de datos
        $departamentos = Departamento::all();
        return view('localidades.create', compact('departamentos'));
    }

      // Almacenar una nueva localidad
    public function store(Request $request)
    {
       
        $request->validate([
            'nombre' => 'required|string|max:255',
            'departamento_id' => 'required|exists:departamentos,id'
        ]);

        
        $localidad = new Localidad();
        $localidad->nombre = $request->nombre;
        $localidad->departamento_id = $request->departamento_id;
        
        $localidad->save();
      
        return redirect()->route('localidades.index')->with('success', 'Localidad creada correctamente.');
    }



    public function show(Localidad $localidad)
    {
        return view('localidades.show', compact('localidad'));
    }

    // Mostrar el formulario para editar una localidad
    public function edit(Localidad $localidad)
    {  
        $departamentos = Departamento::all();

        // Retorna la vista de edición, pasando la localidad y los departamentos
        return view('localidades.edit', compact('localidad', 'departamentos'));
    
    }

    // Actualizar una localidad existente
    public function update(Request $request, Localidad $localidad)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'departamento_id' => 'required|exists:departamentos,id'
        ]);
    
        $localidad->nombre = $request->nombre;
        $localidad->departamento_id = $request->departamento_id;
        $localidad->save();
    
        return redirect()->route('localidades.index')->with('success', 'Localidad actualizada correctamente.');
    
    }

    // Eliminar una localidad
    public function destroy(Localidad $localidad)
    {
        $localidad->delete();
        return redirect()->route('localidades.index')->with('success', 'Localidad eliminada correctamente.');
    }
}
