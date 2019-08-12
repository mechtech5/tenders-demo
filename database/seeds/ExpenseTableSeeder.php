<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpenseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comp_grp')->insert([
            'grp_code' => '1',
            'grp_name' => 'Laxyo Group'
        ]);

        DB::table('comp_mast')->insert([
            [
                'comp_code' => '001',
                'grp_code' => '1',
                'comp_name' => 'LEL'
            ],
            [
                'comp_code' => '002',
                'grp_code' => '1',
                'comp_name' => 'YIPL'
            ],
            [
                'comp_code' => '003',
                'grp_code' => '1',
                'comp_name' => 'LIS'
            ],
            [
                'comp_code' => '004',
                'grp_code' => '1',
                'comp_name' => 'DBF'
            ],
            [
                'comp_code' => '005',
                'grp_code' => '1',
                'comp_name' => 'AMAZON'
            ],
            [
                'comp_code' => '006',
                'grp_code' => '1',
                'comp_name' => 'APNAGPS'
            ]
        ]);
    }
}
