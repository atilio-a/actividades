<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use Illuminate\Http\Request;
use App\Models\Team;


class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::with('entity')->get();
        return view('teams.index', compact('teams'));
    
    }
      // Mostrar el formulario para crear una nueva localidad
    public function create()
    {
           // Cargar todos los departamentos desde la base de datos
        $entities = Entity::all();
        return view('teams.create', compact('entities'));
    }

      // Almacenar una nueva localidad
    public function store(Request $request)
    {
       
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
        ]);

        
        $team = new Team();
        $team->nombre = $request->nombre;
        $team->apellido = $request->apellido;
        $team->observaciones = $request->observaciones;
        $team->telefono = $request->telefono;
        $team->mail = $request->mail;
        $team->entity_id = $request->entity_id;
        
        $team->save();
      
        return redirect()->route('teams.index')->with('success', 'persona creada correctamente.');
    }



    public function show(Team $team)
    {
        return view('teams.show', compact('team'));
    }

    // Mostrar el formulario para editar una localidad
    public function edit(Team $team)
    {  
        $entities = Entity::all();

        // Retorna la vista de edición, pasando la localidad y los departamentos
        return view('teams.edit', compact('team', 'entities'));
    
    }

    // Actualizar una localidad existente
    public function update(Request $request, Team $team)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
           'apellido' => 'required|string|max:255',
        ]);
    
        $team->nombre = $request->nombre;
        $team->apellido = $request->apellido;
        $team->observaciones = $request->observaciones;
        $team->telefono = $request->telefono;
        $team->mail = $request->mail;
        $team->entity_id = $request->entity_id;
        
        $team->save();
        return redirect()->route('teams.index')->with('success', 'Persona actualizada correctamente.');
    
    }

    // Eliminar una localidad
    public function destroy(Team $team)
    {
        $team->delete();
        return redirect()->route('teams.index')->with('success', 'Persona borrada correctamente.');
    }
    
}