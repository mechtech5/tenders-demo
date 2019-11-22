<?php
namespace App\Helpers;
use App\Models\Tenders\Tender;

class Helpers{
	
	public static function getNumber(){
		$tender     = Tender::orderBy('id', 'DESC')->get();
		$ten_no     = explode('-',$tender[0]->tender_no);

		if(!empty($tender[0]->tender_no)){
			$orig_num   = (string)$ten_no[2]+1 ;
			$dig_cou    = strlen((string)$ten_no[2]+1);
			$main_num   = 0;

			if($dig_cou == 1){
				$main_num = '00'.$orig_num;
			}
			elseif($dig_cou == 2){
				$main_num = '0'.$orig_num;
			}

			elseif($dig_cou == 3){
				$main_num = $orig_num;
			}
						
			if($ten_no[0]<=date('Y')){
				 if($ten_no[1] <= date('m')){
				 	return date('Y-m').'-'.$main_num;
			 	 }
				 else{
			 	 	return date('Y-m').'-'.$main_num;	
			 	 }
			}
			else{
			 	return date('Y-m').'-'.$main_num;
			}
						
		}
		else{
			 return date('Y-m').'-000';
			}		
	}
}

 ?>