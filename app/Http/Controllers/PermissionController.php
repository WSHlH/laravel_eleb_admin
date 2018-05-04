<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::paginate(8);
        return view('permission.index',compact('permissions'));
    }

    public function create()
    {
        return view('permission.create');
    }

    public function store(Request $request)
    {
        Permission::create([
            'name'=>$request->name,
            'display_name'=>$request->display_name,
            'description'=>$request->description,
        ]);
        session()->flash('success','添加成功');
        return redirect()->route('permission.index');
    }

    public function edit(Permission $permission)
    {
        return view('permission.edit',compact('permission'));
    }

    public function update(Request $request,Permission $permission)
    {
//        var_dump($permission);die;
        $permission->update([
            'name'=>$request->name,
            'display_name'=>$request->display_name,
            'description'=>$request->description,
        ]);
        session()->flash('success','修改成功');
        return redirect()->route('permission.index');
    }

    public function destroy(Permission $permission)
    {
//        $permissions = DB::select("select count(*) from permission_role where permission_id=?",[$permission->id]);
////        var_dump($permissions);die;
//        if (!empty($permissions)){
//           echo json_encode(1);
//        }else{
            $permission->delete();
            session()->flash('success','删除成功');
//            echo json_encode(0);
//        }

    }
}
