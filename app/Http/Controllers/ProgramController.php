<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\Entity;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::with('entity')->get();
        return view('programs.index', compact('programs'));
    
    }
      // Mostrar el formulario para crear una nueva localidad
    public function create()
    {
           // Cargar todos los departamentos desde la base de datos
        $entities = Entity::all();
        return view('programs.create', compact('entities'));
    }

      // Almacenar una nueva localidad
    public function store(Request $request)
    {
       
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        
        $program = new Program();
        $program->nombre = $request->nombre;
        $program->descripcion = $request->descripcion;
        $program->entity_id = $request->entity_id;
        
        $program->save();
      
        return redirect()->route('programs.index')->with('success', 'programa creado correctamente.');
    }



    public function show(Program $program)
    {
        return view('programs.show', compact('program'));
    }

    // Mostrar el formulario para editar una localidad
    public function edit(Program $program)
    {  
        $entities = Entity::all();

        // Retorna la vista de edición, pasando la localidad y los departamentos
        return view('programs.edit', compact('program', 'entities'));
    
    }

    // Actualizar una localidad existente
    public function update(Request $request, Program $program)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);
    
        $program->nombre = $request->nombre;
        $program->descripcion = $request->descripcion;
        $program->entity_id = $request->entity_id;
        
        $program->save();
        return redirect()->route('programs.index')->with('success', 'Programa actualizada correctamente.');
    
    }

    // Eliminar una localidad
    public function destroy(Program $program)
    {
        $program->delete();
        return redirect()->route('programs.index')->with('success', 'Programa borrada correctamente.');
    }
}
