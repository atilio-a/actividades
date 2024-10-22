<?php

use App\Http\Controllers\ActionController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\CuentaController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FincaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\SeccionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SimulatorController;
use App\Http\Controllers\SummaryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LocalidadController;
use App\Http\Controllers\EntityController;
use App\Http\Controllers\FileUpload;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\OutletMapController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProgramController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Stmt\Echo_;

/* NOOOOOOOOOOOOO tocar siempre comenta
Route::get('generate', function () {
    \Illuminate\Support\Facades\Artisan::call('storage:link');
    echo 'ok';
});

*/
Route::get('/region', [OutletMapController::class, 'region'])->name('outlet_map.region');

Route::get('pdf', [PDFController::class, 'index']);
Route::get('logout', 'App\Http\Controllers\Auth\LoginController@logout');

// Create image upload form
Route::get('/image-upload', 'FileUpload@createForm');

// Store image
Route::post('/image-upload', 'FileUpload@fileUpload')->name('imageUpload');

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');
    Route::resource('products', ProductController::class);
    Route::resource('payments', PaymentController::class);

    Route::resource('customers', CustomerController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('cuentas', CuentaController::class);  
    
    Route::resource('fincas', FincaController::class);
    Route::resource('simulador', SimulatorController::class);
    Route::resource('summary', SummaryController::class);
    Route::resource('creditos', CreditController::class);

    Route::delete('usuarios/{user}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');

    Route::resource('usuarios', UsuarioController::class);

    // Route::get('usuarios/{usuario}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');

    Route::get('usuarios/{user}/show', [UsuarioController::class, 'show'])->name('usuarios.show');
    Route::put('usuarios/{usuario}/edit', [UsuarioController::class, 'edit'])->name('usuarios.update2');
    Route::delete('usuarios/{user}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');

    //  Route::delete('resoluciones/{resolucion}', 'destroy')->name('resoluciones.destroy');


    Route::get('secciones/{seccion}/edit', [SeccionController::class, 'edit'])->name('proveedores.edit');
    Route::get('proveedores/{proveedor}/edit', [ProveedorController::class, 'edit'])->name('secciones.edit');

    Route::resource('secciones', SeccionController::class);

    Route::resource('areas', AreaController::class);

    Route::resource('proveedores', ProveedorController::class);
    Route::resource('actions', ActionController::class);


    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::put('orders/{order}/edit', [OrderController::class, 'update'])->name('orders.update');
    Route::get('orders/{order}/secciones', [OrderController::class, 'secciones'])->name('orders.secciones');
    Route::get('orders/{order}/cuentas', [OrderController::class, 'cuentas'])->name('orders.cuentas');
    Route::get('orders/{order}/descripcion', [OrderController::class, 'descripcion'])->name('orders.descripcion');

    Route::get('orders/{order}/odontograma', [OrderController::class, 'odontograma'])->name('orders.odontograma');

    Route::put('orders/{order}/agregar', [OrderController::class, 'agregar'])->name('orders.agregar');
    Route::put('orders/{order}/agregarCuentas', [OrderController::class, 'agregarCuentas'])->name('orders.agregarCuentas');
    Route::put('orders/{order}/agregarDocumentos', [OrderController::class, 'agregarDocumentos'])->name('orders.agregarDocumentos');
    Route::put('orders/{order}/agregarDescripcion', [OrderController::class, 'agregarDescripcion'])->name('orders.agregarDescripcion');

    Route::put('orders/{order}/agregarDetalle', [OrderController::class, 'agregarDetalle'])->name('orders.agregarDetalle');

    Route::put('orders/{order}/agregarOdontograma', [OrderController::class, 'agregarOdontograma'])->name('orders.agregarOdontograma');



    Route::get('orders/{order}/estado', [OrderController::class, 'estado'])->name('orders.estado');
    Route::put('orders/{order}/actualizarEstado', [OrderController::class, 'actualizarEstado'])->name('orders.actualizarEstado');
    Route::get('orders/seguimiento', [OrderController::class, 'seguimiento'])->name('orders.seguimiento');
    Route::get('/orders/export-csv', [OrderController::class, 'exportCSV'])->name('orders.export.csv');

    Route::get('seguimiento', [OrderController::class, 'seguimiento'])->name('seguimiento');
    Route::get('exportCSV', [OrderController::class, 'exportCSV'])->name('exportCSV');

    Route::get('users/index', [UserController::class, 'index'])->name('users.index');

    //  Route::get('users/create', [UserController::class, 'create'])->name('users.create');

    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{user}/update2', [UserController::class, 'update'])->name('users.update2');
    Route::put('users/{user}/update', [UsuarioController::class, 'update'])->name('users.update');
    Route::delete('users/{user}', [CartController::class, 'destroy'])->name('users.destroy');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::post('/cart/change-qty', [CartController::class, 'changeQty']);
    Route::delete('/cart/delete', [CartController::class, 'delete']);
    Route::delete('/cart/empty', [CartController::class, 'empty']);
    Route::get('/localidades', [LocalidadController::class, 'index'])->name('localidades.index');
    
    Route::get('localidades/{localidad}/edit',   [LocalidadController::class, 'edit'])->name('localidades.edit');
    //Route::put('localidades/{localidad}/update', [LocalidadController::class, 'update'])->name('localidades.update');
    Route::put('localidades/{localidad}', [LocalidadController::class, 'update'])->name('localidades.update');
    Route::delete('localidades/{localidad}', [LocalidadController::class, 'destroy'])->name('localidades.destroy');
    Route::get('localidades/{localidad}',    [LocalidadController::class, 'show'])->name('localidades.show');
    Route::resource('localidades', LocalidadController::class);

    Route::resource('entities', EntityController::class);
    Route::get('/entities', [EntityController::class, 'index'])->name('entities.index');
    Route::get('entities/{entity}/edit',   [EntityController::class, 'edit'])->name('entities.edit');
    Route::get('entities/create', [EntityController::class, 'create'])->name('entities.create');
    Route::put('entities/{entity}', [EntityController::class, 'update'])->name('entities.update');
    Route::delete('entities/{entity}', [EntityController::class, 'destroy'])->name('entities.destroy');
    Route::get('entities/{entity}',    [EntityController::class, 'show'])->name('entities.show');


    Route::resource('teams', TeamController::class);
    Route::get('/teams', [TeamController::class, 'index'])->name('teams.index');
    Route::get('teams/{team}/edit',   [TeamController::class, 'edit'])->name('teams.edit');
    Route::get('teams/create', [TeamController::class, 'create'])->name('teams.create');
    Route::put('teams/{team}', [TeamController::class, 'update'])->name('teams.update');
    Route::delete('teams/{team}', [TeamController::class, 'destroy'])->name('teams.destroy');
    Route::get('teams/{team}',    [TeamController::class, 'show'])->name('teams.show');

   
    Route::resource('programs', ProgramController::class);
    Route::get('/programs', [ProgramController::class, 'index'])->name('programs.index');
    Route::get('programs/{program}/edit',   [ProgramController::class, 'edit'])->name('programs.edit');
    Route::get('programs/create', [ProgramController::class, 'create'])->name('programs.create');
    Route::put('programs/{program}', [ProgramController::class, 'update'])->name('programs.update');
    Route::delete('programs/{program}', [ProgramController::class, 'destroy'])->name('programs.destroy');
    Route::get('programs/{program}',    [ProgramController::class, 'show'])->name('programs.show');

    Route::resource('projects', ProjectController::class);
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('projects/{project}/edit',   [ProjectController::class, 'edit'])->name('projects.edit');
    Route::get('projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::put('projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    Route::get('projects/{project}',    [ProjectController::class, 'show'])->name('projects.show');



    Route::get('/orderItems', [OrderItemController::class, 'index'])->name('orderItems.index');

    Route::get('/download', function () {
        return response()->download(base_path('public/documents/FORMULARIO_INICIO.pdf'));
    });

    Route::get('/our_outlets', [OutletMapController::class, 'index'])->name('outlet_map.index');

    
Route::resource('outlets', OutletController::class);
Route::get('/our_outlets', [OutletMapController::class, 'index'])->name('outlet_map.index');


// Create image upload form
Route::get('/image-upload', 'FileUpload@createForm');

// Store image
Route::post('/image-upload', [FileUpload::class, 'fileUpload'])->name('imageUpload');
/*
Route::get('/image-upload', function () {
     echo('/login11111111');
});
Route::post('/image-upload', function () {
    echo('/login2');
})->name('imageUpload');
*/
// Create image upload form
//Route::get('/image-upload', 'FileUpload@createForm');

// Store image
//Route::post('/image-upload', 'FileUpload@fileUpload')->name('imageUpload');



});
