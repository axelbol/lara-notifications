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
        factory(\App\User::class, 1000)->create();
        // $faker = \Faker\Factory::create();
        // for($i=1; $i <=500; $i++)
        // {
        //     \App\User::create([
        //         'name'  => $faker->name,
        //         'email' => $faker->email,
        //         'password'  => bcrypt('password'),
        //     ]);
        // }
    }
}
