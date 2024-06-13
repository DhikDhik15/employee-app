<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Date;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for($i = 1; $i <= 10; $i++) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'emp_id' => Str::random(5),
                'emp_status' => 1,
                'position' => 'employee',
                'password' => '$2y$10$4yOOm5Ag87w8YofdnHJq0.sPg6Q2UEODp8hqSr8Lhp4Fs7PmF3ssy', // password
                'remember_token' => Str::random(10),
                'join_date' => Date::now()->format('Y-m-d')
            ]);
        }
    }
}
