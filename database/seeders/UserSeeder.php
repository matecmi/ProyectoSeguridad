<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
   /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => null,
            'name' => 'Kevin Williams',
            'email' => 'kevin2010_12@hotmail.com',
            'email_verified_at' => null,
            'password' => Hash::make('1234'),
            'remember_token' => null,
            'created_at' => '2023-05-16 23:50:40',
            'updated_at' => '2023-05-16 23:50:40',
        ]);


        // \App\Models\User::factory(10)->create();
    }
}