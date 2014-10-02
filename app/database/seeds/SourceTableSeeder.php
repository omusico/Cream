<?php

class SourceTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('source')->truncate();

        Source::create(array('name' => 'Llamada'));
        Source::create(array('name' => 'E-Mail'));
        Source::create(array('name' => 'Visita'));
        Source::create(array('name' => 'Importada'));
        Source::create(array('name' => 'Feria'));
        Source::create(array('name' => 'Sitio web'));
        Source::create(array('name' => 'Referencia'));
    }

}