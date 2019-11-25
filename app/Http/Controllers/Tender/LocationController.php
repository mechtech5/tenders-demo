<?php

namespace App\Http\Controllers\Tender;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tenders\Location;

class LocationController extends Controller
{
    public function index()
    {
        $location = Location::all();
        return view('tender.tender_location.index',compact('location'));
    }

    public function create()
    {
        return view('tender.tender_location.create');   
    }

    public function store(Request $request)
    {
        $data = $request->validate(['name' =>'required']);
        Location::create($data);
        return redirect()->route('tender_location.index')->with('success','Created Successfully.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = Location::find($id);
        return view('tender.tender_location.edit',compact('data'));
    }

   
    public function update(Request $request, $id)
    {
        $data = $request->validate(['name' =>'required']);
        Location::where('id',$id)->update($data);
        return redirect()->route('tender_location.index')->with('success','Update Successfully.');
    }

    public function destroy($id)
    {
        Location::destroy($id);
        return redirect()->route('tender_location.index')->with('success','Deleted Successfully.');
    }
}
