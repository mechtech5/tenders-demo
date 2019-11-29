<?php

namespace App\Http\Controllers\Tender;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tenders\Responsible;

class ResponsibleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    
    public function index()
    {
        $respons = Responsible::all();
        return view('tender.respons.index',compact('respons'));
    }

    public function create()
    {
        return view('tender.respons.create');
    }
    
    public function store(Request $request)
    {
        $data = $request->validate(['name'=>'required',
                                    'mobile_no'=>'required',
                                    'emerg_mobile'=>'required',
                                    'desig'=>'required',
                                    'office_loc'=>'required',
                                    'email'=>'required'                             
                                    ]);   
        Responsible::create($data);

        return redirect()->route('tender_responsible.index')->with('success','Created Successfully.');
    }

    public function show($id)
    {
        //
    }
    
    public function edit($id)
    {        
        $data = Responsible::find($id);
        return view('tender.respons.edit',compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate(['name'=>'required',
                                    'mobile_no'=>'required',
                                    'emerg_mobile'=>'required',
                                    'desig'=>'required',
                                    'office_loc'=>'required',
                                    'email'=>'required'                             
                                    ]);   
        Responsible::where('id',$id)->update($data);
        return redirect()->route('tender_responsible.index')->with('success','Update Successfully.');
    }

    public function destroy($id)
    {
        Responsible::destroy($id);
        return redirect()->route('tender_responsible.index')->with('success','Deleted Successfully.');
    }
}
