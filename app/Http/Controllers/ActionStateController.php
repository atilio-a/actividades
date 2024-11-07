<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ActionState;

class ActionStateController extends Controller
{
    public function index(Request $request)
    {
        // inicializamos la consulta con la variable $query
        $query = ActionState::query();

        //  me fijo si viene algun parametro de busqueda
        if ($request->has('search') && $request->search != null) {
            $search = $request->search;
            $query->where('nombre', 'LIKE', "%$search%")
                ->orWhere('descripcion', 'LIKE', "%$search%");
        }
        $actionStates = $query->get();

     
        return view('actionStates.index', compact('actionStates'));
    }
    // Mostrar el formulario para crear una nueva localidad
    public function create()
    {
        return view('actionStates.create');
    }

    // Almacenar una nueva localidad
    public function store(Request $request)
    {

        $request->validate([
            'nombre' => 'required|string|max:255'
        ]);


        $actionState = new ActionState();
        $actionState->nombre = $request->nombre;
        $actionState->descripcion = $request->descripcion;

        $actionState->save();

        return redirect()->route('actionStates.index')->with('success', 'Estado creado correctamente.');
    }



    public function show(ActionState $actionState)
    {
        return view('actionStates.show', compact('actionState'));
    }

    // Mostrar el formulario para editar una localidad
    public function edit(ActionState $actionState)
    {
      

        // Retorna la vista de edición, pasando la localidad y los departamentos
        return view('actionStates.edit', compact('actionState'));
    }

    // Actualizar una localidad existente
    public function update(Request $request, ActionState $actionState)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $actionState->nombre = $request->nombre;
        $actionState->descripcion = $request->descripcion;
        $actionState->save();

        return redirect()->route('actionStates.index')->with('success', 'Estado actualizado correctamente.');
    }

    // Eliminar una localidad
    public function destroy(ActionState $actionState)
    {
        $actionState->delete();
        return redirect()->route('actionStates.index')->with('success', 'Estado eliminado correctamente.');
    }
}
