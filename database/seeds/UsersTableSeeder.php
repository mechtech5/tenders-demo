<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => 'Ayush Likhar',
            'email' => 'alikhar@laxyo.in',
            'password' => bcrypt('laxyo123'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
