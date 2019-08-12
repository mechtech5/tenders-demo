<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BillsController extends Controller
{
    public function index(){
    	return view('expenses.bills.show');
    }
    public function create(){
    	return view('expenses.bills.create');
    }
}
