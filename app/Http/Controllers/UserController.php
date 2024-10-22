<?php

namespace App\Http\Controllers;

use App\Models\Cuenta;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        //  echo $user->id.$user->last_name;
        $cuentas = $user->cuentas;
        foreach ($cuentas as $key => $valor) {
            // echo $key.'-  alor :'.$valor;
        }
        // dd($cuentas);
        // print_r($cuentas);

        return view('users.show')->with('user', $user)->with('cuentas', $cuentas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $cuentas = Cuenta::all();
        $user = $request->user()->getFullname();

        return view('users.create')->with('cuentas', $cuentas)->with('user', $user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->user();
        $cuentas = $request->cuentas;
        // dd($cuentas);
        foreach ($cuentas as $key => $valor) {
            //  dd($key.'-  alor :'.$valor);
            if ($valor > 0) {
                $user->cuentas()->create([
                    'cuenta_id' => $valor, // / precio[id]
                    'user_id' => $user->id, // / precio[id]
                ]);
            }
            // $item->save();
        }

        if (!$user) {
            return redirect()->back()->with('error', 'Sorry, No se creo la User.');
        }

        return redirect()->route('users.create')->with('success', 'User craeda con exito!');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(User $User) {}

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $cuentas = Cuenta::all();

        return view('users.edit', compact('user', 'cuentas'));
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
                'first_name' => 'required|string|max:40',
                'last_name' => 'required|string|max:40',
                'email'  => 'required|email|max:128|unique:users,email,' . $user->id,

            ],
            [
                'email.required' => 'El Email es obligatorio',
                'email.max' => 'El Email no debe exceder los 128 caracteres',
                'email.unique' => 'Ya existe un usuario con este Email',
            ]
        );
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->telefono = $request->telefono;
        $user->email = $request->email;
        $user->entity_id = $request->entity_id;
        $user->rol = $request->rol;
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        if (!$user->save()) {
            return redirect()->back()->with('error', 'Sorry, Something went wrong while updating the User.');
        }

        return redirect()->route('home')->with('success', 'Success, la cuenta ha sido modificada.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'success' => true,
        ]);
    }
}
