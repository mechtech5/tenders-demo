<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasterController extends Controller
{
	public function start_page(){
			$tables = array(
				 	array(			
					 		'table_name' => 'approval_mast',
							'display_name' => 'Approvals',
							'icon' => 'fa fa-user-circle-o',
							'bg_color' => '#009688',
							'count' => DB::table('approval_mast')->where('deleted_at','<>',null)->get()->count()
						),
				array(
							'table_name' => 'comp_mast',
							'display_name' => 'Companies',
							'icon' => 'fa fa-building-o',
							'bg_color' => '#ffc107',
							'count' => DB::table('comp_mast')->get()->count()
							),
			 array(
										'table_name' => 'dept_mast',
										'display_name' => 'Departments',
										'icon' => 'fa fa-shekel',
										'bg_color' => '#dc3545',
										'count' => DB::table('dept_mast')->get()->count()
										),
				 array(
										'table_name' => 'doc_type_mast',
										'display_name' => 'Document Types',
										'icon' => 'fa fa-file-text',
										'bg_color' => '#ff7f07',
										'count' => DB::table('doc_type_mast')->get()->count()
										),
			array(
									'table_name' => 'expense_catg_mast',
									'display_name' => 'Expense Categories',
									'icon' => 'fa fa-money',
									'bg_color' => '#d2335b',
									'count' => DB::table('expense_catg_mast')->where('deleted_at',null)->get()->count()
									),
				array(
									'table_name' => 'desg_mast',
									'display_name' => 'Employee Designations',
									'icon' => 'fa fa-id-card',
									'bg_color' => '#05f3d7db',
									'count' => DB::table('desg_mast')->get()->count()
									),
				array(
									'table_name' => 'emp_event_mast',
									'display_name' => 'Employee Events',
									'icon' => 'fa fa-line-chart',
									'bg_color' => '#3e4a56a6',
									'count' => DB::table('emp_event_mast')->get()->count()
									),
				array(
									'table_name' => 'emp_grade_mast',
									'display_name' => 'Employee Grades',
									'icon' => 'fa fa-id-badge',
									'bg_color' => '#ef041a',
									'count' => DB::table('emp_grade_mast')->get()->count()
									),
			 array(
									'table_name' => 'expense_mode_mast',
									'display_name' => 'Expense Modes',
									'icon' => 'fa fa-modx',
									'bg_color' => '#17a2b8',
									'count' => DB::table('expense_mode_mast')->get()->count()
									),
			array(
							'table_name' => 'tender_client_mast',
							'display_name' => 'Tender Clients',
							'icon' => 'fa fa-user-plus',
							'bg_color' => '#c1c120',
							'count' => DB::table('tender_client_mast')->get()->count()
							),
			array(
									'table_name' => 'emp_status_mast',
									'display_name' => 'Employee Statuses',
									'icon' => 'fa fa-street-view',
									'bg_color' => '#3b35d2db',
									'count' => DB::table('emp_status_mast')->get()->count()
									),
			array(
									'table_name' => 'asset_mast',
									'display_name' => 'Assets',
									'icon' => 'fa fa-anchor',
									'bg_color' => '#ef06ac',
									'count' => DB::table('asset_mast')->get()->count()
									),
				array(
									'table_name' => 'emp_type_mast',
									'display_name' => 'Employee Types',
									'icon' => 'fa fa-user-secret',
									'bg_color' => '#28a745',
									'count' => DB::table('emp_type_mast')->get()->count()
									),
				 array(
									'table_name' => 'tender_catg_mast',
								'display_name' => 'Tender Categories',
								'icon' => 'fa fa-cubes',
								'bg_color' => '#ff0064',
								'count' => DB::table('tender_catg_mast')->get()->count()
								),
				 array(
								'table_name' => 'tender_type_mast',
							'display_name' => 'Tender Types',
							'icon' => 'fa fa-clone',
							'bg_color' => '#22615fa6',
							'count' => DB::table('tender_type_mast')->get()->count()
							),
				 array(
								'table_name' => 'leave_type_mast',
							'display_name' => 'Leave Type',
							'icon' => 'fa fa-users',
							'bg_color' => '#22615fa6',
							'count' => DB::table('leave_type_mast')->get()->count()
							),

				 	array(
				 			'table_name'	=> 'activity_mast',
							'display_name'	=> 'Activity',
							'icon'			=> 'fa fa-futbol-o',
							'bg_color'		=> '#17a2b8',
							'count'			=> DB::table('activity_mast')->get()->count()
						)
				  
				);
			//sort array
			 $temp = '';
       for($i = 0; $i < count($tables); $i++)
	    	{
	    		for ($j = $i+1; $j < count($tables); $j++)
	    		{
	    			if(strtoupper($tables[$i]['display_name']) > strtoupper($tables[$j]['display_name']))
	    			{
	    				$temp = $tables[$i];
	    				$tables[$i] = $tables[$j];
	    				$tables[$j] = $temp;
	    			}
	    		}
	    	}
	    	//sort end
   		return  view('settings.mast_entity.index',compact('tables'));
	}
	public function fetch_name($tbl_name){
		$tables = array(
					'approval_mast' =>  'Approvals',
					'asset_mast' => 'Assets',
					'comp_mast' => 'Companies',
					'dept_mast' =>  'Departments',
					'doc_type_mast' =>'Document Types',
					'emp_status_mast' => 'Employee Statuses',
					'desg_mast' =>  'Employee Designations',
					'emp_type_mast' =>  'Employee Types',
					'emp_event_mast' =>  'Employee Events',
					'expense_catg_mast' =>  'Expense Categories',
					'expense_mode_mast' =>  'Expense Modes',
					'tender_catg_mast' => 'Tender Categories',
					'tender_client_mast' => 'Tender Clients',
					'tender_type_mast' => 'Tender Types',
					'emp_grade_mast' => 'Employee Grades',
					'leave_type_mast' => 'Leave Types',
					'acitvity_mast'		=> 'Activities'
				);
		foreach($tables as $key => $val){
			if($key == $tbl_name){
				return $val;
				break;
			}
		}

	}
	
	public function index($db_table)
	{
		$table_name = $this->fetch_name($db_table);
		$data = DB::table($db_table)->where('deleted_at',null)->get();
		return view('settings.mast_entity.all', compact('data','table_name', 'db_table'));
	}

	public function createOrEditOrShow($method, $db_table, $id = null)
	{
		$table_name = $this->fetch_name($db_table);
		switch ($method) {
	    case "create":
	        return view('settings.mast_entity.create', compact('db_table','table_name'));
	        break;
	    case "edit":
	        $data = DB::table($db_table)->where('id', $id)->first();
					return view('settings.mast_entity.edit', compact('data', 'db_table','table_name'));
	        break;
	    case "show":
	        $data = DB::table($db_table)->where('id', $id)->first();
					return view('settings.mast_entity.show', compact('data', 'db_table','table_name'));
	        break;
	    default:
	        echo "Error";
		}
	}

	public function storeOrUpdate($method, $db_table, $id = null)
	{
		

		switch ($method) {
	    case "store":
		    $vdata = request()->validate([
					'name' => 'required|unique:'.$db_table,
					'description' => 'nullable'
				]);
	      DB::table($db_table)
          ->insert(['name' => $vdata['name'], 'description' => $vdata['description']]);
        break;
	    case "update":
		    $vdata = request()->validate([
					'name' => 'required|unique:'.$db_table.',name,'.$id,
					'description' => 'nullable'
				]);
        DB::table($db_table)
            ->where('id', $id)
            ->update(['name' => $vdata['name'], 'description' => $vdata['description']]);
        break;
	    default:
	        echo "Error";
    }

    return redirect()->route('mast_entity.all',['db_table'=>$db_table]);    
	}

	public function destroy($db_table, $id)
	{
		$data = DB::table($db_table)->where('id', $id)->update(['deleted_at' => date('Y-m-d H:i:s',time())]);
		return redirect()->route('mast_entity.all',['db_table'=>$db_table]);    
	}
}