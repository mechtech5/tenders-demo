<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreVendor;
use Auth;
use App\CompMast;
use App\Vendor;

class VendorsController extends Controller
{
    public function index(){
    	return view('expenses.vendors.show');
    }
    public function create(){
    	$companies = CompMast::all();
    	return view('expenses.vendors.create',compact('companies'));
    }
    public function store(StoreVendor $request){
    	$data = $request->validated();	
    	Vendor::create($data);
    	return redirect()->route('vendors.index')->with('success','Vendor Inserted Successfully');
    	
    }

}
