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
        factory(busRegistration\Order::class, 1000)->create();
        factory(busRegistration\Child::class, 2000)->create();
        factory(busRegistration\Notification::class, 4000)->create();
    }
}
