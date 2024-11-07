<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ActionType;

class ActionTypeController extends Controller
{
    public function index(Request $request)
    {
        // inicializamos la consulta con la variable $query
        $query = ActionType::query();

        //  me fijo si viene algun parametro de busqueda
        if ($request->has('search') && $request->search != null) {
            $search = $request->search;
            $query->where('nombre', 'LIKE', "%$search%")
                ->orWhere('descripcion', 'LIKE', "%$search%");
        }
        $actionTypes = $query->get();

     
        return view('actionTypes.index', compact('actionTypes'));
    }
    // Mostrar el formulario para crear una nueva localidad
    public function create()
    {
        return view('actionTypes.create');
    }

    // Almacenar una nueva localidad
    public function store(Request $request)
    {

        $request->validate([
            'nombre' => 'required|string|max:255'
        ]);


        $actionType = new ActionType();
        $actionType->nombre = $request->nombre;
        $actionType->descripcion = $request->descripcion;

        $actionType->save();

        return redirect()->route('actionTypes.index')->with('success', 'Tipo creado correctamente.');
    }



    public function show(ActionType $actionType)
    {
        return view('actionTypes.show', compact('actionType'));
    }

    // Mostrar el formulario para editar una localidad
    public function edit(ActionType $actionType)
    {
      

        // Retorna la vista de edición, pasando la localidad y los departamentos
        return view('actionTypes.edit', compact('actionType'));
    }

    // Actualizar una localidad existente
    public function update(Request $request, ActionType $actionType)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $actionType->nombre = $request->nombre;
        $actionType->descripcion = $request->descripcion;
        $actionType->save();

        return redirect()->route('actionTypes.index')->with('success', 'Tipo actualizado correctamente.');
    }

    // Eliminar una localidad
    public function destroy(ActionType $actionType)
    {
        $actionType->delete();
        return redirect()->route('actionTypes.index')->with('success', 'Tipo eliminado correctamente.');
    }
}
