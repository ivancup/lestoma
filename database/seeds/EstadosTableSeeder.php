<?php

use Illuminate\Database\Seeder;
use App\Estado;

class EstadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estado::insert([
            ['nombre' => 'HABILITADO', 'valor' => '1'],
            ['nombre' => 'DESHABILITADO', 'valor' => '0']
        ]);
    }
}
