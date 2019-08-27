<?php

namespace App\Exports;
use App\Models\Payment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;

class PaymentsExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize
{
    use Exportable;

    public function query(){

       $data = Payment::with('account','company','expense_in_user','expense_permit_user','expense_mode','vendor')->with(['expense_category' => function($query){
            $query->where('enabled',1);
        }]);
      
        return $data;
    }

    public function map($data): array {
              
        return [
            $data->id,
            $data->company !=null ? $data->company->comp_name : '',
            $data->account != null ? $data->account->name : '',
            date('Y-m-d',strtotime($data->paid_at)),
            $data->amount,
            $data->vendor !=null ? $data->vendor->name : '',
            $data->narration,
            $data->expense_in_user !=null ? $data->expense_in_user->emp_name : '',
            $data->expense_permit_user !=null ? $data->expense_permit_user->emp_name : '',
            $data->email,
            $data->expense_mode !=null ? $data->expense_mode->name : '',
            $data->status == 'A' ? 'Approved' : 'Pending',
            $data->expense_category !=null ? $data->expense_category->name : '',
            $data->req_approval =='1' ? 'Yes' : 'No',
            $data->note,
            $data->created_at,
          
        ];
    }

    public function headings(): array {
        
        return [
        			'sno',
		            'company_name',
		            'account_name',
		            'date',
		            'amount',
		            'vendor_name',
		            'narration',
		            'expense_in_user',
		            'expense_permit',
		            'email',
		            'payment_method',
		            'payment_status',
		            'expense_category',
		            'request_approval',
		            'note',
		            'created_at',		            
		        ];
    }
}
