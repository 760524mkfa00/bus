<?php

use Illuminate\Database\Seeder;

class normalData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('grades')->insert([
            ['grade' => 'Kindergarten'],
            ['grade' => '1'],
            ['grade' => '2'],
            ['grade' => '3'],
            ['grade' => '4'],
            ['grade' => '5'],
            ['grade' => '6'],
            ['grade' => '7'],
            ['grade' => '8'],
            ['grade' => '9'],
            ['grade' => '10'],
            ['grade' => '11'],
            ['grade' => '12']
        ]);

        DB::table('schools')->insert([
            ['school' => 'A S Matheson Elementary'],
            ['school' => 'Anne McClymont Elementary'],
            ['school' => 'Anne McClymont Primary'],
            ['school' => 'Bankhead Elementary'],
            ['school' => 'Belgo Elementary'],
            ['school' => 'Black Mountain Elementary'],
            ['school' => 'Casorso Elementary'],
            ['school' => 'Central School Programs'],
            ['school' => 'Chute Lake Elementary'],
            ['school' => 'Mar Jok Elementary'],
            ['school' => 'Constable Neil Bruce Middle'],
            ['school' => 'Davidson Road Elementary'],
            ['school' => 'Dorothea Walker Elementary'],
            ['school' => 'Dr. Knox Middle'],
            ['school' => 'Ellison Elementary'],
            ['school' => 'George Elliot Secondary'],
            ['school' => 'George Pringle Elementary'],
            ['school' => 'Glenmore Elementary'],
            ['school' => 'Glenrosa Elementary'],
            ['school' => 'Glenrosa Middle'],
            ['school' => 'Helen Gorman Elementary'],
            ['school' => 'Hudson Road Elementary'],
            ['school' => 'Senior Secondary'],
            ['school' => 'KLO Middle'],
            ['school' => 'Mount Boucherie Senior Secondary'],
            ['school' => 'North Glenmore Elementary'],
            ['school' => 'Okanagan Mission Secondary'],
            ['school' => 'Oyama Traditional'],
            ['school' => 'Peachland Elementary'],
            ['school' => 'Pearson Elementary'],
            ['school' => 'Peter Greer Elementary'],
            ['school' => 'Quigley Elementary'],
            ['school' => 'Raymer Elementary'],
            ['school' => 'Rose Valley Elementary'],
            ['school' => 'Rutland Elementary'],
            ['school' => 'Rutland Middle'],
            ['school' => 'Rutland Senior Secondary'],
            ['school' => 'Shannon Lake Elementary'],
            ['school' => 'South Kelowna Elementary'],
            ['school' => 'South Rutland Elementary'],
            ['school' => 'Springvalley Elementary'],
            ['school' => 'Springvalley Middle'],
            ['school' => 'Storefront'],
            ['school' => 'Watson Road Elementary'],
        ]);

        DB::table('roles')->insert([
            ['name' => 'Parent', 'slug' => 'parent', 'permissions' => '{"read-only": true}'],
            ['name' => 'Manager', 'slug' => 'manager', 'permissions' => '{"read-only": true}'],
            ['name' => 'User', 'slug' => 'user', 'permissions' => '{"read-only": true}'],
            ['name' => 'Admin', 'slug' => 'admin', 'permissions' => '{"add-role": true, "view-role": true, "list-grade": true, "create-user": true, "list-school": true, "remove-role": true, "update-user": true, "create-grade": true, "list-student": true, "remove-grade": true, "store-school": true, "create-school": true, "remove-school": true, "store-student": true, "update-school": true, "add-permission": true, "create-student": true, "remove-student": true, "remove-permission": true, "list-tag": true, "create-tag": true, "store-tag": true, "remove-tag": true }']
        ]);

        DB::table('tags')->insert([
            ['tag' => '2nd Pass'],
            ['tag' => 'Accounts'],
            ['tag' => 'Courtesy Wait'],
            ['tag' => 'Mapp Issues'],
            ['tag' => 'Refund'],
            ['tag' => 'Sped Route'],
            ['tag' => 'Waiting for a Response']
        ]);

        DB::table('discounts')->insert([
            ['discount' => 'School Subsidy'],
            ['discount' => 'MOE Subsidy'],
            ['discount' => 'Accounts'],
            ['discount' => 'Transportation']
        ]);
    }
}
