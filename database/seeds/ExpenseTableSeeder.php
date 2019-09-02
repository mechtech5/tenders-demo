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
                'comp_code' => '000',
                'grp_code' => '1',
                'comp_name' => 'Management',
                'tour_enable' => 0

            ],
            [
                'comp_code' => '001',
                'grp_code' => '1',
                'comp_name' => 'LEL',
                'tour_enable' => 1

            ],
            [
                'comp_code' => '002',
                'grp_code' => '1',
                'comp_name' => 'YIPL',
                'tour_enable' => 1
            ],
            [
                'comp_code' => '003',
                'grp_code' => '1',
                'comp_name' => 'LIS',
                'tour_enable' => 0
            ],
            [
                'comp_code' => '004',
                'grp_code' => '1',
                'comp_name' => 'DBF',
                'tour_enable' => 0
            ],
            [
                'comp_code' => '005',
                'grp_code' => '1',
                'comp_name' => 'AMAZON',
                'tour_enable' => 0
            ],
            [
                'comp_code' => '006',
                'grp_code' => '1',
                'comp_name' => 'APNAGPS',
                'tour_enable' => 0
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
                'comp_code'  => '000',
                'login_user' => '2',
                'emp_name'   => 'Y Sir',
                'emp_gender' => 'M',
                'emp_dob'    => '1994-06-26',
                'grade_code' => 'A',
                'emp_desg'   => '1'
            ],
             [ 
                'comp_code'  => '000',
                'login_user' => '3',
                'emp_name'   => 'HS Sir',
                'emp_gender' => 'M',
                'emp_dob'    => '1994-06-26',
                'grade_code' => 'A',
                'emp_desg'   => '2'
            ],
             [ 
                'comp_code'  => '000',
                'login_user' => '4',
                'emp_name'   => 'HR - User',
                'emp_gender' => 'M',
                'emp_dob'    => '1994-06-26',
                'grade_code' => 'A',
                'emp_desg'   => '3'
            ],
             [ 
                'comp_code'  => '001',
                'login_user' => '5',
                'emp_name'   => 'TL comp 1',
                'emp_gender' => 'M',
                'emp_dob'    => '1994-06-26',
                'grade_code' => 'A',
                'emp_desg'   => '4'
            ],
             [ 
                'comp_code'  => '002',
                'login_user' => '6',
                'emp_name'   => 'TL Comp 2',
                'emp_gender' => 'M',
                'emp_dob'    => '1994-06-26',
                'grade_code' => 'A',
                'emp_desg'   => '5'
            ],

            [ 
                'comp_code'  => '004',
                'login_user' => '1',
                'emp_name'   => 'Aayush Likhar',
                'emp_gender' => 'M',
                'emp_dob'    => '1993-06-26',
                'grade_code' => 'A',
                'emp_desg'   => '1'
            ],

            [ 
                'comp_code'  => '004',
                'login_user' => '7',
                'emp_name'   => 'Vinod Kurmi',
                'emp_gender' => 'M',
                'emp_dob'    => '1993-06-26',
                'grade_code' => 'A',
                'emp_desg'   => '1'
            ],

            [ 
                'comp_code'  => '004',
                'login_user' => '8',
                'emp_name'   => 'Ritesh Panchal',
                'emp_gender' => 'M',
                'emp_dob'    => '1996-06-26',
                'grade_code' => 'A',
                'emp_desg'   => '1'
            ],
            [ 
                'comp_code'  => '004',
                'login_user' => '9',
                'emp_name'   => 'Abhishek Soni',
                'emp_gender' => 'M',
                'emp_dob'    => '1994-06-26',
                'grade_code' => 'A',
                'emp_desg'   => '1'
            ],



        ]);     
        DB::table('tour_status')->insert([

            [ 
                'title'  => 'Created',
            ],

            [ 
                'title'  => 'TL approval',
            ],

            [ 
                'title'  => 'YS Sir approval',
            ],
            [ 
                'title'  => 'Advance Amount Released',
            ],
            [ 
                'title'  => 'Tour started',
            ],
            [ 
                'title'  => 'Tour ended',
            ],
            [ 
                'title'  => 'HS Sir Approval',
            ],
            [ 
                'title'  => 'Account Final',
            ],
        ]); 
         DB::table('desg_mast')->insert([
            [ 
                'comp_code'  => '000',
                'title'  => 'Director1 (Y Sir)',
            ],
            [ 
                'comp_code'  => '000',
                'title'  => 'Director2 (HS Sir)',
            ],
            [ 
                'comp_code'  => '000',
                'title'  => 'HR',
            ],
            [ 
                'comp_code'  => '001',
                'title'  => 'TL',
            ],
            [ 
                'comp_code'  => '002',
                'title'  => 'TL',
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
