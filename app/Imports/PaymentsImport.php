<?php

namespace App\Imports;

use App\Models\Demo;
use App\Models\CompMast;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PaymentsImport implements ToCollection, WithHeadingRow
{
     public function collection(Collection $rows){
        
        $status = TRUE;
        $error =array();

        foreach ($rows as $row){
        

          //Company Validation
            if($status == TRUE){
                $compaines = CompMast::where('comp_name',$row['company_name'])->get();
                if(count($compaines) !=0){
                    $status =TRUE;
                }
                else{
                    $error[] = $row['company_name'];
                    $status = FALSE; 
                }
            }
                       

            dd($status);
            die;
        }
    
      
    
        // foreach ($rows as $row){
        //     Demo::create([
        //         'comp_code'     => $row['company_name'],
        //         'account_id'    => $row['account_name'],
        //         'amount'        => $row['amount'],
        //         'status'        => $row['status'],
        //         'req_approval'  => $row['Request Approval'],
        //     ]);
        // }
    }
}
