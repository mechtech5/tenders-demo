<?php

namespace App\Http\Controllers\Tender;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tenders\TenderItems;

class ItemsController extends Controller
{
    public function index()
    {
        $item = TenderItems::all();
        return view('tender.items.index',compact('item'));
    }

    public function create()
    {
        return view('tender.items.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate(['name'     =>'required',
                                    'unit_name'=>'required',
                                    'remarks'  =>'nullable'     
                                    ]);

        $data['unit_name'] = strtoupper($data['unit_name']);
        $data['name']      = ucfirst($data['name']);        
        TenderItems::create($data);
        return redirect()->route('tender_item.index')->with('success','Created Successfully.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = TenderItems::find($id);
        return view('tender.items.edit',compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate(['name'     =>'required',
                                    'unit_name'=>'required',
                                    'remarks'  =>'nullable'     
                                    ]);
        $data['unit_name'] = strtoupper($data['unit_name']);
        $data['name']      = ucfirst($data['name'] );
        TenderItems::where('id',$id)->update($data);
        return redirect()->route('tender_item.index')->with('success','Update Successfully.');
    }

    public function destroy($id)
    {
        TenderItems::destroy($id);
        return redirect()->route('tender_item.index')->with('success','Deleted Successfully.');
    }
}
