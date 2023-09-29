<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tarea;
class TareasController extends Controller
{
    public function RegisterCreate (Request $request){
        $User = new user();
        
        $User -> name = $request ->post("name"); 
        $User -> surname = $request ->post("surname");
        $User -> age = $request ->post("age");
        $User -> email = $request ->post("email");
        $User -> password = Hash::make($request -> post("password"));
        $User -> save();       
        return $User;
    }
}
