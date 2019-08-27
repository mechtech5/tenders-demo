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
        DB::table('expense_mode_mast')->insert([
            [
                'grp_code' => '1',
                'name' => 'Cash'
            ],
            [
                'grp_code' => '1',
                'name' => 'NEFT'
            ],
            
        ]);
         
        DB::table('account_mast')->insert([
            [
                'comp_code'         => '001',
                'name'              => 'account LEL',
                'opening_balance'   => '2000000.00',
                'bank_name'         => 'HDFC BANK',
                'bank_phn'        => '0171-9980239',
                'bank_addr'      => 'Indore, Madhya Pradesh',


            ],
            [
                'comp_code'         => '002',
                'name'              => 'account YIPL',
                'opening_balance'   => '2000000.00',
                'bank_name'         => 'AXIS BANK',
                'bank_phn'        => '0171-3823240',
                'bank_addr'      => 'Indore, Madhya Pradesh',
            ],



        ]);
        DB::table('emp_mast')->insert([

            [ 
                'comp_code'  => '001',
                'login_user' => '1',
                'emp_name'   => 'Aayush Likhar',
                'emp_gender' => 'M',
                'emp_dob'    => '1993-06-26',
                'grade_code' => 'A',
                'emp_desg'   => '1'
            ],

            [ 
                'comp_code'  => '006',
                'login_user' => '2',
                'emp_name'   => 'Vinod Kurmi',
                'emp_gender' => 'M',
                'emp_dob'    => '1993-06-26',
                'grade_code' => 'A',
                'emp_desg'   => '1'
            ],

            [ 
                'comp_code'  => '001',
                'login_user' => '3',
                'emp_name'   => 'Ritesh Panchal',
                'emp_gender' => 'M',
                'emp_dob'    => '1996-06-26',
                'grade_code' => 'A',
                'emp_desg'   => '1'
            ],
            [ 
                'comp_code'  => '006',
                'login_user' => '4',
                'emp_name'   => 'Abhishek Soni',
                'emp_gender' => 'M',
                'emp_dob'    => '1994-06-26',
                'grade_code' => 'A',
                'emp_desg'   => '1'
            ],



        ]);     
        DB::table('exp_bill_statuses')->insert([
            [
                'comp_code' => '001',
                'name'       => 'Draft',
                'code'       => 'draft',
            ],
            [
                'comp_code' => '001',
                'name'       => 'Received',
                'code'       => 'received',
            ],
            [
                'comp_code' => '001',
                'name'       => 'Partial',
                'code'       => 'partial',
            ],
            [
                'comp_code' => '001',
                'name'       => 'Paid',
                'code'       => 'paid',
            ],

        ]);      

    }
}
