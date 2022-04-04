<?php

use Illuminate\Database\Seeder;

class DevelopersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('developers')->insert(['nome'=>'Wesley Silva','cargo'=>'Analista Pleno']);
        DB::table('developers')->insert(['nome'=>'Paulo Silva','cargo'=>'Analista Senior']);
        DB::table('developers')->insert(['nome'=>'Anderson Silva','cargo'=>'Programador Jr']);
    }
}
