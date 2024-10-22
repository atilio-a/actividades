<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Action;
use App\Models\Departamento;
use App\Models\Entity;
use App\Models\Localidad;
use App\Models\Program;
use App\Models\Project;
use App\Models\Team;

class ActionController extends Controller
{
    public function index()
    {
        $actions = Action::with('localidad')->get();
        return view('actions.index', compact('actions'));
    
    }
      // Mostrar el formulario para crear una nueva action
    public function create()
    {
           // Cargar todos los departamentos desde la base de datos
        $localidades = Localidad::all();
        $entidades = Entity::all();
        $personas = Team::all();

        $programs = Program::all();
        $projects = Project::all();
        return view('actions.create', compact('programs','projects','personas','localidades','entidades'));
    }

      // Almacenar una nueva action
    public function store(Request $request)
    {
       
        $request->validate([
            'nombre' => 'required|string|max:255',
            'localidad_id' => 'required|exists:localidades,id'
        ]);

        
        $action = new Action();
        $action->nombre = $request->nombre;
        $action->localidad_id = $request->localidad_id;
        $action->team_id = $request->team_id;
        $action->program_id = $request->program_id;
        $action->project_id = $request->project_id;
        $action->direccion = $request->direccion;
        $action->entity_id = $request->entity_id;
        $action->fecha = $request->fecha;
        $action->codigo = $request->codigo;
        $action->repuesta = $request->repuesta;
        $action->respuesta_fecha = $request->respuesta_fecha;
        $action->telefono = $request->telefono;
        $action->monto_estimado = $request->monto_estimado;
        $action->tags = $request->tags;
        $action->descripcion = $request->descripcion;
        
        $action->save();
        return redirect()->route('outlets.create', ['action_id' => $action->id])->with('success', 'Actividad creada correctamente.');
      

       // return redirect()->route('actions.index')->with('success', 'action creada correctamente.');
    }



    public function show(Action $action)
    {
        return view('actions.show', compact('action'));
    }

    // Mostrar el formulario para editar una action
    public function edit(action $action)
    {  
        $localidades = Localidad::all();
        $entidades = Entity::all();
        $personas = Team::all();
        $programs = Program::all();
        $projects = Project::all();
       
        return view('actions.edit', compact('action','programs','projects','personas','localidades','entidades'));

    
    }

    // Actualizar una action existente
    public function update(Request $request, action $action)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'localidad_id' => 'required|exists:localidades,id'
        ]);
    
        $action->nombre = $request->nombre;
        $action->localidad_id = $request->localidad_id;
        $action->team_id = $request->team_id;
        $action->program_id = $request->program_id;
        $action->project_id = $request->project_id;
        $action->direccion = $request->direccion;
        $action->entity_id = $request->entity_id;
        $action->fecha = $request->fecha;
        $action->codigo = $request->codigo;
        $action->repuesta = $request->repuesta;
        $action->respuesta_fecha = $request->respuesta_fecha;
        $action->telefono = $request->telefono;
        $action->monto_estimado = $request->monto_estimado;
        $action->tags = $request->tags;
        $action->descripcion = $request->descripcion;
        $action->save();
    
        return redirect()->route('actions.index')->with('success', 'action actualizada correctamente.');
    
    }

    // Eliminar una action
    public function destroy(action $action)
    {
        $action->delete();
        return redirect()->route('actions.index')->with('success', 'action eliminada correctamente.');
    }
}
