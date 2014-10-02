<?php

class StatusTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status')->truncate();

        Status::create(array('name' => 'Frío', 'color' => 'blue'));
        Status::create(array('name' => 'Templado', 'color' => 'green'));
        Status::create(array('name' => 'Caliente', 'color' => 'red'));
        Status::create(array('name' => 'Seguimiento', 'color' => 'grey'));
    }

}