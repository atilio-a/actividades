<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Image;
use App\Models\Outlet;
use Illuminate\Http\Request;

class OutletController extends Controller
{
    /**
     * Display a listing of the outlet.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        //*$this->authorize('manage_outlet');

        $outletQuery = Outlet::query();
        $outletQuery->where('name', 'like', '%'.request('q').'%');
        $outlets = $outletQuery->paginate(25);

        return view('outlets.index', compact('outlets'));
    }

    /**
     * Show the form for creating a new outlet.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        //$this->authorize('create', new Outlet);
       $action_id= $request->get("action_id");
       $action = Action::find($action_id);
//print_r($action);
        return view('outlets.create', compact('action'));
    }

    /**
     * Store a newly created outlet in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        //$this->authorize('create', new Outlet);

        $newOutlet = $request->validate([
            'name'      => 'required|max:60',
            'action_id'   => 'nullable',
            'observacion'   => 'nullable|max:255',
            'celular'   => 'nullable|max:25',
            'email'     => 'nullable|email',
            'latitude'  => 'required|required_with:longitude|max:15',
            'longitude' => 'required|required_with:latitude|max:15',
        ]);
		
		if(empty(auth()->id())){
			$newOutlet['creator_id'] = 2;
		}else
             $newOutlet['creator_id'] = auth()->id();

        $outlet = Outlet::create($newOutlet);

       // return redirect()->route('outlets.show', $outlet);
        return redirect()->route('outlet_map.index');
    
    }

    /**
     * Display the specified outlet.
     *
     * @param  \App\Outlet  $outlet
     * @return \Illuminate\View\View
     */
    public function show(Outlet $outlet)
    {
        
        
        $imgQuery = Image::query();
        $imgQuery->where('outlet_id', '=', $outlet->id);
        $imagenes = $imgQuery->paginate(5);
        
       // print_r($imagenes);
        
        return view('outlets.show', compact('outlet','imagenes') );
    }

    /**
     * Show the form for editing the specified outlet.
     *
     * @param  \App\Outlet  $outlet
     * @return \Illuminate\View\View
     */
    public function edit(Outlet $outlet)
    {
        $this->authorize('update', $outlet);

        return view('outlets.edit', compact('outlet'));
    }

    /**
     * Update the specified outlet in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Outlet  $outlet
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, Outlet $outlet)
    {
        $this->authorize('update', $outlet);

        $outletData = $request->validate([
            
             'name'      => 'required|max:60',
            'address'   => 'nullable|max:255',
            'observacion'   => 'nullable|max:255',
            'celular'   => 'nullable|max:25',
            'email'     => 'nullable|email',
            'latitude'  => 'nullable|required_with:longitude|max:15',
            'longitude' => 'nullable|required_with:latitude|max:15',
        ]);
        $outlet->update($outletData);

        return redirect()->route('outlets.show', $outlet);
    }

    /**
     * Remove the specified outlet from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Outlet  $outlet
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, Outlet $outlet)
    {
        $this->authorize('delete', $outlet);

        $request->validate(['outlet_id' => 'required']);

        if ($request->get('outlet_id') == $outlet->id && $outlet->delete()) {
            return redirect()->route('outlets.index');
        }

        return back();
    }
}
