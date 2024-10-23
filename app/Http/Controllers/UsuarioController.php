<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use App\Models\Entity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = new User();

        if ($request->nombre) {
            $users = $users->where('first_name', 'LIKE', '%' . $request->nombre . '%');
        }
        if ($request->apellido) {
            $users = $users->where('last_name', 'LIKE', '%' . $request->apellido . '%');
        }

        $users = $users->latest()->paginate(20);

        //$users = User::latest()->paginate(10);

        return view('usuarios.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $entities = Entity::all();
        return view('usuarios.create', compact('entities'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $User = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'rol' => $request->rol,
            'password' => Hash::make($request->password),
            'entity_id' => $request->entity_id,
            'telefono' => $request->telefono,
        ]);

        if (!$User) {
            return redirect()->back()->with('error', ' No se logor registrar el usuario.');
        }

        return redirect()->route('usuarios.index')->with('success', 'usuario creado con exito!');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        // echo 'usuarios.index:::::::::::::::'.$user;
        $user->first_name = $user->first_name;
        $user->last_name = $user->last_name;
        $user->email = $user->email;
        $user->entity_id = $user->entity_id;
        $user->rol = 'COMUN';
        $user->telefono = $user->telefono;

        if (!$user->save()) {
            return redirect()->back()->with('error', 'Sorry, Something went wrong while updating the User.');
        }

        return redirect()->route('usuarios.index')->with('success', $user->first_name . ' ' . $user->last_name . ' - Cuenta Activada, la cuenta ha sido modificada para ingresar al sistema.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $usuario)
    {
        $entities = Entity::all();

//        return view('teams.edit', compact('team', 'entities'));
    
        return view('usuarios.edit',compact ('usuario', 'entities'))->with('user', $usuario);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate(
            request(),
            [
                'first_name' => 'required|string|max:20',
                'last_name' => 'required|string|max:20',
                'email'  => 'required|email|max:255|unique:users,email,' . $user->id,

            ],
            [
                'email.required' => 'El Email es obligatorio',
                'email.max' => 'El Email no debe exceder los 128 caracteres',
                'email.unique' => 'Ya existe un usuario con este Email',
            ]
        );

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->rol = $request->rol;
        $user->password = Hash::make($request->password);
        $user->entity_id = $request->entity_id;
        $user->telefono = $request->telefono;

        if (!$user->save()) {
            return redirect()->back()->with('error', 'Sorry, Something went wrong while updating the User.');
        }

        return redirect()->route('usuarios.index')->with('success', 'Success, la cuenta ha sido modificada.');
    }

    public function destroy(User $user)
    {

        // echo($user->id);
        if ($user->avatar) {
            Storage::delete($user->avatar);
        }

        $user->delete();

        return response()->json([
            'success' => true,
        ]);
    }
}
