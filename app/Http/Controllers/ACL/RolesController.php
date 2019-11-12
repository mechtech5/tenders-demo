<?php

namespace App\Http\Controllers\ACL;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;


class RolesController extends Controller
{
      public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
       
        $show_role    = DB::table('roles')->get();
        $permissions  = DB::table('permissions')->get();
        $user         = User::all();
        return view('acl.admin_satting',compact('show_role','permissions','user'));
    }
   
    public function create()
    {
        return view('acl.role.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate(['name' => 'required']);
        $data['created_at'] = date("Y-m-d H:i:s"); 
        $name = $request->name;  

        $role = Role::create(['name' => $name]);
         return redirect('admin');
    }

    public function show($id)
    {
        $permison_list = DB::table('role_has_permissions')->where('role_id',$id)->get();
        $permission_ids = array();
        foreach ($permison_list as $var) {
            $permission_ids[] = $var->permission_id;
        }
        
        $role = Role::find($id);
        $permissions = DB::table('permissions')->get();
        return view('acl.role.show',compact('role','permissions','permission_ids'));
    }

    public function edit($id)
    {
        $data = DB::table('roles')->find($id);
        return view('acl.role.edit',compact('data'));
    }
   
    public function update(Request $request, $id)
    {
        $id  = $request->id;
        $request->validate(['name' => 'required']);
        
        $update['name'] = $request->name; 
        $update['updated_at'] = date("Y-m-d H:i:s");
        DB::table('roles')->where('id',$id)->update($update);
        return redirect('admin');
    }

    public function destroy($id)
    {
         DB::table('roles')->where('id',$id)->delete();
         return redirect('admin');
    }

    public function saveChanges(Request $request){
        $role       = Role::findOrFail($request->roleId);
        $permissionid = $request->permissionId;
        $role->syncPermissions($permissionid);
        return "Permissions Save" ;
    }
}
