<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vendor;
class PaymentsController extends Controller
{
    
    public function index()
    {
        return view('expenses.payments.show');
    }

   
    public function create()
    {
        $vendors = Vendor::all();
        return view('expenses.payments.create',compact('vendors'));
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        //
    }

  
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    }
}
