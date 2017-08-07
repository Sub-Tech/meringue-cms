<?php

use Illuminate\Database\Seeder;

class PluginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        (new \App\Plugin([
            'class_name' => 'Plugins\Meringue\Text\Text',
            'file_name' => 'Plugins/Meringue/Text/Text.php',
            'name' => 'Text'
        ]))->save();
    }
}
