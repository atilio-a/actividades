<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Action;
use App\Models\Entity;
use App\Models\Program;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $last30Days = date('Y-m-d H:i:s', strtotime('-30 days'));

         $usuarios_sistema = User::count();
         $actividades = Action::where('created_at', '>=', $last30Days)->count();
         $entidades = Entity::count();
         $programas = Program::count();




        return view('home',compact( 'usuarios_sistema', 'actividades', 'entidades', 'programas'));
    }
}
