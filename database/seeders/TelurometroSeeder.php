<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class TelurometroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('telurometros')->insert([
            'nombre'=>'TELUROMETRO MEGABRAS MODELO EM4058',
            'tipo'=>'',
            'marca'=>'MEGABRAS',
            'modelo'=>'EM4058',
            'serie'=>'',
            'fechacalib'=>Carbon::parse('2021-07-01'),
            'vigenciacalib'=>'1',

        ]);
    }
}
