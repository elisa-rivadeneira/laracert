<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FirmaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('firmas')->insert([
            'nombre'=>'Edo Olivera Rudas',
            'cip'=>'86254',
            'especialidad'=>'Ing. Electrica',
            'colegiaturafile'=>'/images/c8765456.jpg',
            'fotopic'=>'/images/f8765456.jpg',
            'firmapic'=>'/images/firmas/firma01.jpg'

        ]);

        DB::table('firmas')->insert([
            'nombre'=>'Fernando Reyes',
            'cip'=>'8765456',
            'especialidad'=>'Ing. Electrica',
            'colegiaturafile'=>'/images/c8765456.jpg',
            'fotopic'=>'/images/f8765456.jpg',
            'firmapic'=>'/images/firmas/firma02.jpg'

        ]);

        DB::table('firmas')->insert([
            'nombre'=>'Rodrigo Campos',
            'cip'=>'323423',
            'especialidad'=>'Ing. Electrica',
            'colegiaturafile'=>'/images/c323423.jpg',
            'fotopic'=>'/images/f323423.jpg',
            'firmapic'=>'/images/firmas/firma03.jpg'
        ]);

        DB::table('firmas')->insert([
            'nombre'=>'Silvia Canta',
            'cip'=>'645546',
            'especialidad'=>'Ing. Electrica',
            'colegiaturafile'=>'/images/c645546.jpg',
            'fotopic'=>'/images/f645546.jpg'
        ]);
    }
}
