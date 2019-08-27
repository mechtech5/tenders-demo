<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\CompMast;
use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    	$designations = Designation::with('company')->get();
      return view('settings.designations.index',compact('designations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    		$companies = CompMast::where('enabled',1)->get();
        $designations = Designation::all();
        return view('settings.designations.create',compact('designations','companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
	   			'title'	=> 'required|string|max:100',
	   			'company'	=> 'required',
	   			'description'	=> 'required',
	   		]);
				$designation  = new Designation;
				$designation->title = $data['title'];
				$designation->comp_code = $data['company'];
				$designation->description = $data['description'];
				$designation->save();

	   		$designations = Designation::with('company')->get();
      	return view('settings.designations.index',compact('designations'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $designation = Designation::find($id);
        $companies = CompMast::where('enabled',1)->get();
   			return view('settings.designations.edit',compact('designation','companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $data = $request->validate([
	   			'title'	=> 'required|string|max:100',
	   			'company'	=> 'required',
	   			'description'	=> 'required',
	   		]);
         $designation = Designation::find($id);
         $designation->title = $data['title'];
         $designation->comp_code = $data['company'];
         $designation->description = $data['description'];
         $designation->save();
	   		return redirect()->route('designations.index')->with('success','Designation Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $designation = Designation::find($id);
        $designation->delete();
        $designations = Designation::with('company')->get();
      	return view('settings.designations.index',compact('designations'));
    }
}
