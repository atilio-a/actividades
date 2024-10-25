<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Action;
use App\Models\Departamento;
use App\Models\Entity;
use App\Models\Image;
use App\Models\Localidad;
use App\Models\Program;
use App\Models\Project;
use App\Models\Team;

class ActionController extends Controller
{
    public function index(Request $request)
    {
        // Iniciamos la consulta para obtener las acciones con la relación de 'localidad'
        $query = Action::orderBy('id',  'desc')->with('localidad');

        // Verificamos si hay un término de búsqueda
        if ($request->has('search') && $request->search != null) {
            $search = $request->search;
            // Filtramos las acciones por el contenido de las columnas 'nombre' y 'descripcion', o por el nombre de la localidad
            $query->where('nombre', 'LIKE', "%$search%")
                ->orWhere('descripcion', 'LIKE', "%$search%")
                ->orWhereHas('localidad', function ($q) use ($search) {
                    $q->where('nombre', 'LIKE', "%$search%");
                })
                ->orWhereHas('entidad', function ($q) use ($search) {
                    $q->where('nombre', 'LIKE', "%$search%");
                });
        }

        // Ejecutamos la consulta y obtenemos las acciones filtradas
        $actions = $query->get();

        // Retornamos la vista con las acciones filtradas
        return view('actions.index', compact('actions'));
    }
      // Mostrar el formulario para crear una nueva action
    public function create()
    {
           // Cargar todos los departamentos desde la base de datos
        $localidades = Localidad::orderBy('nombre', 'asc')->get();
        $entidades = Entity::orderBy('nombre', 'asc')->get();
        $personas = Team::orderBy('apellido', 'asc')->get();

        $programs = Program::orderBy('nombre', 'asc')->get();
        $projects = Project::orderBy('nombre', 'asc')->get();
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
        //return redirect()->route('outlets.create', ['action_id' => $action->id])->with('success', 'Actividad creada correctamente.');
      
        return redirect()->route('actions.show', $action)->with('success', 'Actividad creada correctamente.');

       // return redirect()->route('actions.index')->with('success', 'action creada correctamente.');
    }



    public function show(Action $action)
    {

        $imgQuery = Image::query();
        $imgQuery->where('action_id', '=', $action->id);
        $imagenes = $imgQuery->paginate(5);
        
       //($action->mapa);
     
        return view('actions.show', compact('action','imagenes'));
    }

    // Mostrar el formulario para editar una action
    public function edit(action $action)
    {  
             // Cargar todos los departamentos desde la base de datos
             $localidades = Localidad::orderBy('nombre', 'asc')->get();
             $entidades = Entity::orderBy('nombre', 'asc')->get();
             $personas = Team::orderBy('apellido', 'asc')->get();
     
             $programs = Program::orderBy('nombre', 'asc')->get();
             $projects = Project::orderBy('nombre', 'asc')->get();
       
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
