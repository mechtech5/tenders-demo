<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	[
            'name' => 'Ayush Likhar',
            'email' => 'alikhar@laxyo.in',
            'password' => bcrypt('laxyo123'),
            'created_at' => now(),
            'updated_at' => now()
        ],
      	[
            'name' => 'Y Sir',
            'email' => 'ysir@laxyo.in',
            'password' => bcrypt('laxyo123'),
            'created_at' => now(),
            'updated_at' => now()
        ],
      	[
            'name' => 'HS Sir',
            'email' => 'hsir@laxyo.in',
            'password' => bcrypt('laxyo123'),
            'created_at' => now(),
            'updated_at' => now()
        ],
      	[
            'name' => 'HR- user',
            'email' => 'hr@laxyo.in',
            'password' => bcrypt('laxyo123'),
            'created_at' => now(),
            'updated_at' => now()
        ],
      	[
            'name' => 'TL comp 1',
            'email' => 'tl1@laxyo.in',
            'password' => bcrypt('laxyo123'),
            'created_at' => now(),
            'updated_at' => now()
        ],
      	[
            'name' => 'TL comp 2',
            'email' => 'tl2@laxyo.in',
            'password' => bcrypt('laxyo123'),
            'created_at' => now(),
            'updated_at' => now()
        ]
      ]);
    }
}
