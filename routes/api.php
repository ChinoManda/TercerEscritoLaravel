<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TareasController;


Route::prefix('v1')->group(function(){
    Route::post("/tarea", [TareasController::class,"Create"]);
    Route::get("/tarea/{d}", [TareasController::class,"ListOne"]);
    });
    
