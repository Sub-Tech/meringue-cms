<?php

use Illuminate\Database\Seeder;

class BlockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        (new \App\Block([
            'section_id' => 1,
            'order' => 1,
            'width' => 3,
            'plugin_class' => 'Meringue\Text'
        ]))->save();
    }
}
