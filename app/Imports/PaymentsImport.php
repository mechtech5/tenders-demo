<?php

namespace App\Imports;

use App\Models\Payment;
use App\Models\CompMast;
use App\Models\AccountMast;
use App\Models\Vendor;
use App\Models\EmployeeMast;
use App\Models\ExpenseInUser;
use App\Models\ExpensePermitUser;
use App\Models\ExpenseMode;
use App\Models\ExpenseCategory;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;
class PaymentsImport implements ToCollection, WithHeadingRow
{
     public function collection(Collection $rows){
        
        
        // return $rows;
       
    
             // dd($error);
            
        // foreach ($rows as $row){
        //     Demo::create([
        //         'comp_code'     => $row['company_name'],
        //         'account_id'    => $row['account_name'],
        //         'amount'        => $row['amount'],
        //         
        //         'req_approval'  => $row['Request Approval'],
        //     ]);
        // }
    }
}
