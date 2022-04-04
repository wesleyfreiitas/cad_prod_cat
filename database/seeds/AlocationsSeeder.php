<?php

use Illuminate\Database\Seeder;

class AlocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('alocations')->insert(['project_id'=>1,'developer_id'=>1, 'horas_semanais'=>11]);
        DB::table('alocations')->insert(['project_id'=>1,'developer_id'=>2, 'horas_semanais'=>13]);
        DB::table('alocations')->insert(['project_id'=>2,'developer_id'=>2, 'horas_semanais'=>24]);
        DB::table('alocations')->insert(['project_id'=>2,'developer_id'=>3, 'horas_semanais'=>35]);
        DB::table('alocations')->insert(['project_id'=>3,'developer_id'=>1, 'horas_semanais'=>16]);
        DB::table('alocations')->insert(['project_id'=>3,'developer_id'=>2, 'horas_semanais'=>17]);
        DB::table('alocations')->insert(['project_id'=>3,'developer_id'=>3, 'horas_semanais'=>5]);

    }
}
