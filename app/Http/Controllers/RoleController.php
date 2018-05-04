<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::paginate(8);
        return view('role.index',compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('role.create',compact('permissions'));
    }

    public function store(Request $request)
    {
            $owner = new Role();
            $owner->name         =$request->name;
            $owner->display_name =$request->display_name;
            $owner->description  =$request->description;
            $owner->save();
            $owner->syncPermissions($request->role);
        session()->flash('success','添加成功');
        return redirect()->route('role.index');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
//        var_dump($role->permissions()->get());die;

//        $permissionss = $role->permissions;
//        $p=[];
//        foreach($permissionss as $permission){
//            $p[]=$permission->id;
//        }
//        var_dump($permissionss);die;
        return view('role.edit',compact('role','permissions'));
    }

    public function update(Request $request,Role $role)
    {
            $role->update([
            'name' => $request->name,
            'display_name' => $request->display_name,
            'description' => $request->description,
            ]);
            $role->syncPermissions($request->role);
        session()->flash('success','修改成功');
        return redirect()->route('role.index');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        $role->syncPermissions([]);
        session()->flash('success','删除成功');
    }
}
