<?php

namespace App\Http\Controllers\ACL;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;

class UserController extends Controller
{
      public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
    }

  
    public function create()
    {
        return view('acl.users.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[ 'name' =>'required',
                                   'email' => 'required|email|unique:users,email'
                                 ]);
        $password = substr($request->name,0,4).'1234';
        $name['name']     = strtolower($request->name);
        $name['password'] = $password;
        $name['username'] = $request->email;
        $data = array(
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($password),
                );
        User::insert($data);
        Mail::to($request->email)->send(new SendMailable($name));
        return redirect('admin');
    }

   
    public function show($id)
    {
        $data  = array();
        $data['user']        = User::find($id);
        $data['role']        = Role::get();
        $data['permissions'] = Permission::get();
        $permission          = DB::table('model_has_permissions')->where('model_id',$id)->get();
        $role                = DB::table('model_has_roles')->where('model_id',$id)->get();
        $user                = User::all();        

        $permission_ids = array();
        $role_ids = array();
        foreach ($permission as $ids) {
            $permission_ids[] = $ids->permission_id; 
        }

        foreach ($role as $roles) {
            $role_ids[] = $roles->role_id; 
        }

        return view('acl.users.show',compact('data','permission_ids','user','role_ids'));
    }

    
    public function edit($id)
    {
        $data = User::find($id);
        return view('acl.users.edit',compact('data'));
    }

   
    public function update(Request $request, $id)
    {
        $this->validate($request,[ 'name' =>'required',
                                  ]);
        $data = User::find($id);
    
        $data['name'] = $request->name;
        if(!empty($request->password)){
            $data['password'] = Hash::make($request->password);
        }
       $data->save();
        return redirect('admin');
    }

    
    public function destroy($id)
    {
        User::destroy($id);
        DB::table('fleet_mast')->where('fleet_owner',$id)->delete();
        return redirect('admin');
    }

    public function changesRole(Request $request){
        $userId = $request->userId;
        $roleId = $request->roleId;

        $user = User::where('id', '=', $userId)->firstOrFail();
        $user->roles()->sync($roleId);
    }

    public function changePermission(Request $request){
        $user         = User::findOrFail($request->userId);
        $permissionid = $request->permissionId;
        $user->syncPermissions($permissionid);
    }
}
