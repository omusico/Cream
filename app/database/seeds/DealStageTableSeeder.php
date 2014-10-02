<?php

class DealStageTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('deal_stage')->truncate();

        DealStage::create(array('name' => 'Cliente potencial', 'probability' => 5));
        DealStage::create(array('name' => 'Solicitud de información', 'probability' => 25));
        DealStage::create(array('name' => 'Presentación', 'probability' => 50));
        DealStage::create(array('name' => 'Negociación', 'probability' => 75));
        DealStage::create(array('name' => 'Ganado', 'probability' => 100));
        DealStage::create(array('name' => 'Perdido', 'probability' => 0));
    }

}