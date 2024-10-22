<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Entity;


class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('entity')->get();
        return view('projects.index', compact('projects'));
    
    }
      // Mostrar el formulario para crear una nueva localidad
    public function create()
    {
           // Cargar todos los departamentos desde la base de datos
        $entities = Entity::all();
        return view('projects.create', compact('entities'));
    }

      // Almacenar una nueva localidad
    public function store(Request $request)
    {
       
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        
        $project = new Project();
        $project->nombre = $request->nombre;
        $project->descripcion = $request->descripcion;
        $project->entity_id = $request->entity_id;
        
        $project->save();
      
        return redirect()->route('projects.index')->with('success', 'projecta creado correctamente.');
    }



    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    // Mostrar el formulario para editar una localidad
    public function edit(Project $project)
    {  
        $entities = Entity::all();

        // Retorna la vista de edición, pasando la localidad y los departamentos
        return view('projects.edit', compact('project', 'entities'));
    
    }

    // Actualizar una localidad existente
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);
    
        $project->nombre = $request->nombre;
        $project->descripcion = $request->descripcion;
        $project->entity_id = $request->entity_id;
        
        $project->save();
        return redirect()->route('projects.index')->with('success', 'Projecta actualizada correctamente.');
    
    }

    // Eliminar una localidad
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Projecta borrada correctamente.');
    }
}