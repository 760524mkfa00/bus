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
//        factory(busRegistration\User::class, 4500)->create();
        factory(busRegistration\Order::class, 500)->create();
        factory(busRegistration\Child::class, 500)->create();
        factory(busRegistration\Notification::class, 100)->create();
    }
}
