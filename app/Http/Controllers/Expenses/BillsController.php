<?php

namespace App\Http\Controllers\Expenses;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BillsController extends Controller
{
	public function __construct(){
        $this->middleware('auth');
    }
   	public function index(){
        return view('expenses.bills.show');
    }
    public function create(){
        return view('expenses.bills.create');
    }
}
