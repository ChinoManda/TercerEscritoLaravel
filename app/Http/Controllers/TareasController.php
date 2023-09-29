<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tarea;
use Illuminate\Support\Facades\Validator;
class TareasController extends Controller
{

    public function Create(Request $request){
        
        $validation = self::CreateTareaValidation($request);

        if ($validation->fails())
        return $validation->errors();
    
        return $this -> CreateRequest($request);
    }

    public function CreateValidation(Request $request){
        $validation = Validator::make($request->all(),[
            'titulo' => 'required | string ',
            'contenido' => 'required | string',
            'estado' => 'required',
            'autor' => 'required',
        ]);
        return $validation;    
    }

    public function CreateRequest (Request $request){
        $Tarea = new tarea();
        
        $Tarea -> titulo = $request ->post("titulo"); 
        $Tarea -> contenido = $request ->post("contenido");
        $Tarea -> estado = $request ->post("estado");
        $Tarea -> autor = $request ->post("autor");
        $Tarea -> save();       
        return $Tarea;
    }

    public function ListOne($id){
        $Tarea = tarea::findOrFail($id);
        return $Tarea;
    }

    public function ListAll(){
        return tarea::all();
    }
}
