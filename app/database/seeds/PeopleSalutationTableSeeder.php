<?php

class PeopleSalutationTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('people_salutation')->truncate();

        PeopleSalutation::create(array('name' => 'Sr.'));
        PeopleSalutation::create(array('name' => 'Sra.'));
        PeopleSalutation::create(array('name' => 'Srta.'));
        PeopleSalutation::create(array('name' => 'Dr.'));
        PeopleSalutation::create(array('name' => 'Prof.'));
    }

}