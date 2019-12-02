<?php

namespace App\Http\Controllers\Tender;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tenders\Responsible;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\User;

class ResponsibleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    
    public function index()
    {
        $respons = User::where('parent_id',Auth::user()->id)->get();
        return view('tender.respons.index',compact('respons'));
    }

    public function create()
    {
        return view('tender.respons.create');
    }
    
    public function store(Request $request)
    {
        $data = $request->validate(['name'     =>'required',                                    
                                    'email'    =>'required',
                                    'can_login'=>'nullable'                                    
                                    ]);           
        $data['password']  = Hash::make('laxyo123');
        $data['parent_id'] = Auth::user()->id;
        User::create($data);

        return redirect()->route('tender_responsible.index')->with('success','Created Successfully.');
    }

    public function show($id)
    {
        //
    }
    
    public function edit($id)
    {        
        $data = User::find($id);
        return view('tender.respons.edit',compact('data'));
    }

    public function update(Request $request, $id)
    {
         $data = $request->validate(['name'     =>'required',                                    
                                    'email'    =>'required',
                                    'can_login'=>'nullable'                                    
                                    ]);           
         if($request->password){
                $data['password']  = Hash::make($request->password);
            }
        User::where('id',$id)->update($data);
        return redirect()->route('tender_responsible.index')->with('success','Update Successfully.');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('tender_responsible.index')->with('success','Deleted Successfully.');
    }
}
