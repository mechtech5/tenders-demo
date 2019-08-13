<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VendorsController extends Controller
{
    public function index(){
    	return view('expenses.vendors.show');
    }
    public function create(){
    	return view('expenses.vendors.create');
    }
}
