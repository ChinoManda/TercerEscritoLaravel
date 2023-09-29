<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class tareasSeeder extends Seeder
{
    public function run()
    {
        DB::table('tareas')->insert([
            'titulo' => "hola",
            'contenido' => "adios",
            'estado' => "soltero",
            'autor' => "yo",
        ]);
    }
}
