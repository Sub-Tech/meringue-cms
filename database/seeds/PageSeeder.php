<?php

use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void

     */
    public function run()
    {
        (new \App\Page([
            'name' => 'Home',
            'slug' => '/',
            'user_id' => '1',
        ]))->save();

        (new \App\Page([
            'name' => 'Sample Page',
            'slug' => 'sample-page',
            'user_id' => '1',
        ]))->save();
    }
}
