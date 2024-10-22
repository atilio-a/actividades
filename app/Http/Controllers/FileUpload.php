<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class FileUpload extends Controller
{
    //
    
    
     public function createForm(){
    return view('file-upload');
  }

  public function fileUpload(Request $req){
        $req->validate([
        'imageFile' => 'required',
         'imageFile.*' => 'image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        
        
        if($req->hasFile('imageFile')){
            foreach ($req->file('imageFile') as $imagen) {
                 $fileName = $imagen->getClientOriginalName();
                 //$filePath= public_path().'/image/' .$fileName;
                 $imagen->move('uploads', $fileName, 'public');
                  $fileModel = new Image() ;
     

            $fileModel->outlet_id = $req->outlet_id;
            $fileModel->name = $fileName;
            $fileModel->image_path = '/uploads/' . $fileName;
            $fileModel->save();
            }
            
            
        }
               
       ////Session::flash('message', 'Las Imagenes han sido registradas con exito!');

            return back()
            ->with('success','!!! Las Imagenes han sido registradas con exito!!!!!!!!.')
            ->with('file', $fileName);
        
   }
}
