<?php

namespace App\Http\Controllers\ACL;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use DB;

class PermissionController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('acl.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(['name' => 'required']);
        $data['created_at'] = date("Y-m-d H:i:s");  
        $name = $request->name;

        $role = Permission::create(['name' => $name]);
        return redirect('admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $data = DB::table('permissions')->find($id);
        return view('acl.permissions.edit',compact('data'));
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
        $id  = $request->id;
        $this->validate($request,['name' => 'required','guard_name'=>'required']);
        
        $update['name'] = $request->name;
        $update['guard_name'] = $request->guard_name;
        $update['updated_at'] = date("Y-m-d H:i:s");
        DB::table('permissions')->where('id',$id)->update($update);
        return redirect('admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('permissions')->where('id',$id)->delete();
         return redirect('admin');
    }
}
