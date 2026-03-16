<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Crojasm',
            'email' => 'rojas.maraboli@gmail.com',
            'password' => bcrypt('1234'),
        ]);

        DB::table('tbl_tipos')->insert([
            ['gls_tipo' => 'Boleta de Garantia', 'tipo' => 1, 'estado' => 0],
            ['gls_tipo' => 'Contrato', 'tipo' => 1, 'estado' => 0],
            ['gls_tipo' => 'CI', 'tipo' => 1, 'estado' => 0],
            ['gls_tipo' => 'Venciomiento Boleta', 'tipo' => 2, 'estado' => 0],
            ['gls_tipo' => 'Presentar documemtos', 'tipo' => 2, 'estado' => 0],
            ['gls_tipo' => 'Hito Inicio Obra', 'tipo' => 2, 'estado' => 0],
        ]);

        DB::table('tbl_programas')->insert([
            ['gls_programa' => 'DS10', 'estado' => 0],
            ['gls_programa' => 'DS20', 'estado' => 0],
            
        ]);

         DB::table('tbl_comunas')->insert([
            ['gls_comuna' => 'Quilpué', 'estado' => 0],
            ['gls_comuna' => 'Viña del Mar', 'estado' => 0],
            
        ]);

        // $this->call([
        //     TipoSeeder::class,
        // ]);
    }
}
