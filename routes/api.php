<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TareasController;


Route::prefix('v1')->group(function(){
    Route::post("/tarea", [TareasController::class,"Create"]);
    Route::post("/tarea/{d}", [TareasController::class,"Edit"]);
    Route::get("/tarea/{d}", [TareasController::class,"ListOne"]);
    Route::get("/tarea", [TareasController::class,"ListAll"]);
    });
    
