<?php

use Illuminate\Database\Seeder;

class ProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('projects')->insert(['nome'=>'Sistema de alocação de recursos','estimativa_horas'=>200]);
        DB::table('projects')->insert(['nome'=>'Sistema de biblioteca','estimativa_horas'=>1000]);
        DB::table('projects')->insert(['nome'=>'Sistema de vendas','estimativa_horas'=>2000]);
        DB::table('projects')->insert(['nome'=>'Novo sistema','estimativa_horas'=>5000]);
    }
}
