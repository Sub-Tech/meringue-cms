<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        (new \App\User([
            'name' => 'James Lewis',
            'email' => 'james@stechga.co.uk',
            'password' => bcrypt('password')
        ]))->save();
    }
}
