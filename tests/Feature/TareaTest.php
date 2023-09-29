<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TareaTest extends TestCase
{

    public function test_CreateGoodRequest(){
        $response = $this ->post('/api/v1/tarea', [
                "titulo"=> "Titulazo",
                "contenido"=> "si",
                "estado"=> "indomable",
                "autor"=> "yo quien mas",
        ]);
        $response -> assertStatus(201);
        $response -> assertJsonStructure([
                "titulo",
                "contenido",
                "estado",
                "autor",
        ]);
        $this->assertDatabaseHas('tareas', [
            "titulo"=> "Titulazo",
            "contenido"=> "si",
            "estado"=> "indomable",
            "autor"=> "yo quien mas",
        ]);
     
    }


        public function test_CreateBadRequest(){
            
            $response = $this ->post('/api/v1/tarea', [
        ]);

            $response -> assertStatus(200);
            
            $response -> assertJsonFragment([
                    "titulo"=> ["The titulo field is required."],
                    "contenido"=> ["The contenido field is required."],
                    "estado"=> ["The estado field is required."],
                    "autor"=> ["The autor field is required."],
            ]);
        }
}
