<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entity;


class EntityController extends Controller
{
    public function index(Request $request)
    {
        $query = Entity::query();

        if ($request->has('search') && $request->search != null){
            $search = $request->search;
            $query->where('nombre','LIKE', "%$search%")
                ->orWhere('descripcion','LIKE',"%$search%")
                ->orWhereHas('entity',function($q) use ($search){
                    $q->where('nombre','LIKE',"%$search");
                });
        }

        $entities = $query->get();

//        $entities = Entity::with('entidad_padre')->get();
        return view('entities.index', compact('entities'));
    }

    public function show(Entity $entity)
    {
        return view('entities.show', compact('entity'));
    }

    public function edit(Entity $entity)
    {  
        $entidades_padre = Entity::all();

        // Retorna la vista de edición, pasando la entidad y las entidades padre
        return view('entities.edit', compact('entity', 'entidades_padre'));
    
    }

    // Actualizar una Entidad existente
    public function update(Request $request, Entity $entity)
    {
        $request->validate([
            'nombre' => 'required|string|max:255'
        ]);

        $entity->descripcion = $request->descripcion;
        $entity->nombre = $request->nombre;
        $entity->entity_id = $request->entity_id;
        $entity->user_id = $request->user()->id;
        $entity->telefono = $request->telefono;
        $entity->mail = $request->mail;

        $entity->save();
    
        return redirect()->route('entities.index')->with('success', 'Entidad actualizada correctamente.');
    
    }
    public function create()
    {
           // Cargar todos los departamentos desde la base de datos
        $entidades_padre = Entity::all();
        return view('entities.create', compact('entidades_padre'));
    }

      // Almacenar una nueva localidad
    public function store(Request $request)
    {
       
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);
        
        $entity = new Entity();
        $entity->descripcion = $request->descripcion;
        $entity->nombre = $request->nombre;
        $entity->entity_id = $request->entity_id;
        $entity->user_id = $request->user()->id;
        $entity->telefono = $request->telefono;
        $entity->mail = $request->mail;

        $entity->save();
      
        return redirect()->route('entities.index')->with('success', 'Entidad creada correctamente.');
    }


}
