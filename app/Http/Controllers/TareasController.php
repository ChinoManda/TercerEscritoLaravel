<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tarea;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class TareasController extends Controller
{

    public function Create(Request $request){
        
        $validation = self::CreateValidation($request);

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

        try {
            DB::raw('LOCK TABLE tareas WRITE');
            DB::beginTransaction();

        $Tarea = new tarea();
        
        $Tarea -> titulo = $request ->post("titulo"); 
        $Tarea -> contenido = $request ->post("contenido");
        $Tarea -> estado = $request ->post("estado");
        $Tarea -> autor = $request ->post("autor");
        $Tarea -> save();       
        return $Tarea;
        }
        catch (\Illuminate\Database\QueryException $th) {
            DB::rollback();
            return $th->getMessage();
        }
        catch (\PDOException $th) {
            return response("Permission to DB denied",403);
        }
    }

    public function ListOne($id){
        try {
            DB::raw('LOCK TABLE tareas WRITE');
            DB::beginTransaction();

        $Tarea = tarea::findOrFail($id);
        return $Tarea;
        }
        catch (\Illuminate\Database\QueryException $th) {
            DB::rollback();
            return $th->getMessage();
        }
        catch (\PDOException $th) {
            return response("Permission to DB denied",403);
        }
    }

    public function ListAll(){
        try {
            DB::raw('LOCK TABLE tareas WRITE');
            DB::beginTransaction();
        return tarea::all();
        }
        catch (\Illuminate\Database\QueryException $th) {
            DB::rollback();
            return $th->getMessage();
        }
        catch (\PDOException $th) {
            return response("Permission to DB denied",403);
        }
    }


    public function Edit(Request $request, $id){
        
        $validation = self::EditValidation($request);

        if ($validation->fails())
        return $validation->errors();
    
        $Tarea = tarea::findOrFail($id);
        if ($Tarea){
        return $this -> EditRequest($request, $Tarea);
        }
        return $Tarea;
    }

    public function EditValidation(Request $request){
        $validation = Validator::make($request->all(),[
            'titulo' => 'required | string ',
            'contenido' => 'required | string',
            'estado' => 'required',
            'autor' => 'required',
        ]);
        return $validation;    
    }

    public function EditRequest (Request $request, tarea $Tarea){

        try {
            DB::raw('LOCK TABLE tareas WRITE');
            DB::beginTransaction();

        $Tarea -> titulo = $request ->post("titulo"); 
        $Tarea -> contenido = $request ->post("contenido");
        $Tarea -> estado = $request ->post("estado");
        $Tarea -> autor = $request ->post("autor");
        $Tarea -> save();       
        return $Tarea;
        }
        catch (\Illuminate\Database\QueryException $th) {
            DB::rollback();
            return $th->getMessage();
        }
        catch (\PDOException $th) {
            return response("Permission to DB denied",403);
        }
    }

    public function Delete($id)
    {
        try {
        DB::raw('LOCK TABLE tareas WRITE');
        DB::beginTransaction();

         $Tarea = tarea::findOrFail($id);  
         $Tarea->delete(); 
         return ["response" => "Object with ID $Tarea->id Deleted"];

        }
        catch (\Illuminate\Database\QueryException $th) {
            DB::rollback();
            return $th->getMessage();
        }
        catch (\PDOException $th) {
            return response("Permission to DB denied",403);
        }
    }
}
