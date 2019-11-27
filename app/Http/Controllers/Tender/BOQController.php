<?php

namespace App\Http\Controllers\Tender;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BOQController extends Controller
{
   public function index()
    {
        return view('tender.BOQ.index');
    }

    public function create()
    {
        return view('tender.BOQ.create');   
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
