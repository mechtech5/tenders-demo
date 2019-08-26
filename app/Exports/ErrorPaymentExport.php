<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
// use Illuminate\Contracts\View\View;
// use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ErrorPaymentExport implements FromCollection, WithHeadings, ShouldAutoSize
{
	  use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */
  
		public $error;

		public function __construct($error){

			$this->error = $error;
		}

		public function collection(){
	        	$error = $this->error;
	        return collect($error);
	    }

   
		 public function headings(): array
		    {
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
		        ];
		    }
	
}
