<?php

namespace App\Http\Controllers\Tender;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tenders\UnitsMast;

class UnitController extends Controller
{
  
    public function index()
    {
        $unit = UnitsMast::all();
        return view('tender.unit.index',compact('unit'));
    }

    public function create()
    {
        return view('tender.unit.create');   
    }

    public function store(Request $request)
    {
        $data = $request->validate(['name' =>'required',
                                    'descr'=>'nullable'     
                                    ]);
        $data['name'] = strtoupper($data['name']);
        UnitsMast::create($data);       
        return redirect()->route('tender_unit.index')->with('success','Created Successfully.');
    }

    public function show($id)
    {
        //
    }

  
    public function edit($id)
    {
        $data = UnitsMast::find($id);
        return view('tender.unit.edit',compact('data')); 
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate(['name' =>'required',
                                    'descr'=>'nullable'     
                                    ]);
        $data['name'] = strtoupper($data['name']);
        UnitsMast::where('id',$id)->update($data);       
        return redirect()->route('tender_unit.index')->with('success','Update Successfully.');
    }

    public function destroy($id)
    {
        UnitsMast::destroy($id);
        return redirect()->route('tender_unit.index')->with('success','Delete Successfully.');
    }
}
