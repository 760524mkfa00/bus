<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(normalData::class);
        factory(busRegistration\User::class, 500)->create();
        factory(busRegistration\Child::class, 1000)->create();
    }
}
