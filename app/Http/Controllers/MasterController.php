<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasterController extends Controller
{
	public function index($db_table)
	{
		$data = DB::table($db_table)->get();
		return view('mast_entity/all', compact('data', 'db_table'));
	}

	public function createOrEditOrShow($method, $db_table, $id = null)
	{
		switch ($method) {
	    case "create":
	        return view('mast_entity/create', compact('db_table'));
	        break;
	    case "edit":
	        $data = DB::table($db_table)->where('id', $id)->first();
					return view('mast_entity/edit', compact('data', 'db_table'));
	        break;
	    case "show":
	        $data = DB::table($db_table)->where('id', $id)->first();
					return view('mast_entity/show', compact('data', 'db_table'));
	        break;
	    default:
	        echo "Error";
		}
	}

	public function storeOrUpdate($method, $db_table, $id = null)
	{
		$vdata = request()->validate([
			'name' => 'required|unique:'.$db_table,
			'description' => 'nullable'
		]);

		switch ($method) {
	    case "store":
	      DB::table($db_table)
          ->insert(['name' => $vdata['name'], 'description' => $vdata['description']]);
        break;
	    case "update":
        DB::table($db_table)
            ->where('id', $id)
            ->update(['name' => $vdata['name'], 'description' => $vdata['description']]);
        break;
	    default:
	        echo "Error";
    }

    return back();    
	}

	public function destroy($db_table, $id)
	{
		$data = DB::table($db_table)->where('id', $id)->delete();
	}
}