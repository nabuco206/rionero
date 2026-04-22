<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Crojasm',
            'email' => 'rojas.maraboli@gmail.com',
            'password' => bcrypt('1234'),
        ]);

        DB::table('tbl_tipos')->insert([
            ['gls_tipo' => 'Boleta de Garantia', 'tipo' => 1, 'estado' => 0],
            ['gls_tipo' => 'Contrato', 'tipo' => 1, 'estado' => 0],
            ['gls_tipo' => 'CI', 'tipo' => 1, 'estado' => 0],
            ['gls_tipo' => 'Vencimiento Boleta', 'tipo' => 2, 'estado' => 0],
            ['gls_tipo' => 'Presentar documentos', 'tipo' => 2, 'estado' => 0],
            ['gls_tipo' => 'Hito Inicio Obra', 'tipo' => 2, 'estado' => 0],
        ]);

        DB::table('tbl_programas')->insert([
            ['gls_programa' => 'DS10', 'estado' => 0],
            ['gls_programa' => 'DS27', 'estado' => 0],
            ['gls_programa' => 'DS49', 'estado' => 0],
            ['gls_programa' => 'DS50', 'estado' => 0],
            ['gls_programa' => 'PPPF', 'estado' => 0],
            ['gls_programa' => 'VIVIENDA TIPO', 'estado' => 0],
            ['gls_programa' => 'TODOS', 'estado' => 0],
        ]);

        DB::table('tbl_comunas')->insert([
            ['gls_comuna' => 'SAN ANTONIO', 'estado' => 0],
            ['gls_comuna' => 'QUILLOTA', 'estado' => 0],
            ['gls_comuna' => 'LA CALERA', 'estado' => 0],
            ['gls_comuna' => 'HIJUELAS', 'estado' => 0],
            ['gls_comuna' => 'VILLA ALEMANA', 'estado' => 0],
            ['gls_comuna' => 'VALPARAISO', 'estado' => 0],
            ['gls_comuna' => 'LIMACHE', 'estado' => 0],
            ['gls_comuna' => 'NOGALES', 'estado' => 0],
            ['gls_comuna' => 'OLMUE', 'estado' => 0],
            ['gls_comuna' => 'VIÑA DEL MAR', 'estado' => 0],
            ['gls_comuna' => 'PUCHUNCAVI', 'estado' => 0],
            ['gls_comuna' => 'REGIONAL', 'estado' => 0],
        ]);

        $this->call([
            ProyectoSeeder::class,
        ]);
    }
}