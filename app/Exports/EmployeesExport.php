<?php

namespace App\Exports;
use App\Models\Employees\EmployeeMast;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;

class EmployeesExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize
{
    use Exportable;

	public function query(){

		$employees = EmployeeMast::where('deleted_at', null);

		return $employees;
	}

	public function map($employees): array {

		return [
			$employees->id,
			$employees->parent_id,
			$employees->emp_code,
			$employees->comp_id,
			$employees->dept_id,
			$employees->desg_id,
			$employees->grade_id,
			$employees->emp_name,
			$employees->emp_img,
			$employees->emp_gender,
			$employees->emp_dob,
			$employees->curr_addr,
			$employees->perm_addr,
			$employees->blood_grp,
			$employees->contact,
			$employees->alt_contact,
			$employees->email,
			$employees->alt_email,
			$employees->driv_lic,
			$employees->aadhar_no,
			$employees->voter_id,
			$employees->pan_no,
			$employees->emp_type,
			$employees->emp_status,
			$employees->old_uan,
			$employees->curr_uan,
			$employees->old_pf,
			$employees->curr_pf,
			$employees->old_esi,
			$employees->curr_esi,
			$employees->join_dt,
			$employees->leave_dt,
			$employees->active
			];
	}
    
    public function headings(): array {
        
        return [
			'id',
			'parent_id',
			'emp_code',
			'comp_id',
			'dept_id',
			'desg_id',
			'grade_id',
			'emp_name',
			'emp_img',
			'emp_gender',
			'emp_dob',
			'curr_addr',
			'perm_addr',
			'blood_grp',
			'contact',
			'alt_contact',
			'email',
			'alt_email',
			'driv_lic',
			'aadhar_no',
			'voter_id',
			'pan_no',
			'emp_type',
			'emp_status',
			'old_uan',
			'curr_uan',
			'old_pf',
			'curr_pf',
			'old_esi',
			'curr_esi',
			'join_dt',
			'leave_dt',
			'active'
		];
	}

}
