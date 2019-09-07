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
        DB::table('comp_mast')->insert([
            'comp_name' => 'Laxyo Group'
        ]);

        DB::table('dept_mast')->insert([
        		[
                'comp_id' => 1,
                'dept_name' => 'Management',
                'tour_enabled' => 0
            ],
            [
                'comp_id' => 1,
                'dept_name' => 'LEL',
                'tour_enabled' => 1
            ],
            [
                'comp_id' => 1,
                'dept_name' => 'YIPL',
                'tour_enabled' => 1
            ],
            [
                'comp_id' => 1,
                'dept_name' => 'LIS',
                'tour_enabled' => 0
            ],
            [
                'comp_id' => 1,
                'dept_name' => 'DBF',
                'tour_enabled' => 0
            ],
            [
                'comp_id' => 1,
                'dept_name' => 'AMAZON',
                'tour_enabled' => 0
            ],
            [
                'comp_id' => 1,
                'dept_name' => 'APNAGPS',
                'tour_enabled' => 0
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
        	//1
        	 [ 
                'comp_id'  => '1',
                'emp_name'   => 'Y Sir',
                'emp_gender' => 'M',
                'emp_dob'    => '1994-06-26',
                'desg_id'   => '1'
            ],
            //2
             [ 
                'comp_id'  => '1',
                'emp_name'   => 'HS Sir',
                'emp_gender' => 'M',
                'emp_dob'    => '1994-06-26',
                'desg_id'   => '2'
            ],
            //3
             [ 
                'comp_id'  => '1',
                'emp_name'   => 'HR - User',
                'emp_gender' => 'M',
                'emp_dob'    => '1994-06-26',
                'desg_id'   => '3'
            ],
            //4
             [ 
                'comp_id'  => '1',
                'emp_name'   => 'TL comp 1',
                'emp_gender' => 'M',
                'emp_dob'    => '1994-06-26',
                'desg_id'   => '4'
            ],
            //5
             [ 
                'comp_id'  => '1',
                'emp_name'   => 'TL Comp 2',
                'emp_gender' => 'M',
                'emp_dob'    => '1994-06-26',
                'desg_id'   => '5'
            ],
            //6
            [ 
                'comp_id'  => '1',
                'emp_name'   => 'Aayush Likhar',
                'emp_gender' => 'M',
                'emp_dob'    => '1993-06-26',
                'desg_id'   => '1'
            ],
            //7
            [ 
                'comp_id'  => '1',
                'emp_name'   => 'Vinod Kurmi',
                'emp_gender' => 'M',
                'emp_dob'    => '1993-06-26',
                'desg_id'   => '1'
            ],
            //8
            [ 
                'comp_id'  => '1',
                'emp_name'   => 'Ritesh Panchal',
                'emp_gender' => 'M',
                'emp_dob'    => '1996-06-26',
                'desg_id'   => '1'
            ],
            //9
            [ 
                'comp_id'  => '1',
                'emp_name'   => 'Abhishek Soni',
                'emp_gender' => 'M',
                'emp_dob'    => '1994-06-26',
                'desg_id'   => '1'
            ],
        ]);     
         DB::table('desg_mast')->insert([
            [ 
                'comp_id'  => 1,
                'desg_name'  => 'Director1 (Y Sir)',
            ],
            [ 
                'comp_id'  => 1,
                'desg_name'  => 'Director2 (HS Sir)',
            ],
            [ 
                'comp_id'  => 1,
                'desg_name'  => 'HR',
            ],
            [ 
                'comp_id'  => 1,
                'desg_name'  => 'TL',
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
