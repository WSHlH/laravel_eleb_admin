<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(5);
        return view('user.index',compact('users'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        //检测
        $this->validate($request,[
            'name'=>'required|min:2|max:10',
            'password'=>'required|min:3|max:16',
        ]);
        User::create([
            'name'=>$request->name,
            'password'=>bcrypt($request->name),
        ]);
        //保存成功,提示并跳转
        session()->flash('success','管理员注册成功!');
        return redirect()->route('user.index');
    }

    public function edit(User $user)
    {
        return view('user.edit',compact('user'));
    }

    public function update(Request $request,User $user )
    {
        //检测
        $this->validate($request,[
            'name'=>['required','min:2','max:10',Rule::unique('users')->ignore($user->id)],
//            'old_password'=>'min:3|max:16',
            'password'=>'required|min:3|max:16',
        ]);
//        $pwd = bcrypt($request->old_password);
//        $password = $user->password;
//        var_dump($pwd);
//        var_dump($password);
//        die;
//        var_dump(Auth::attempt(['password'=>$request->old_password]));die;
//        var_dump(Hash::check($request->old_password,Auth::user()->password));die;
        if(Hash::check($request->old_password,Auth::user()->password)){
            $user->update([
                'name'=>$request->name,
                'password'=>bcrypt($request->password),
            ]);
            //保存成功,提示并跳转
            session()->flash('success','管理员信息修改成功!请重新登录');
            //清除登录信息,重新登录
            Auth::logout();
            return redirect()->route('login');
        }else{
            //保存失败,提示并跳转
            session()->flash('warning','原密码或新密码填写错误!');
            return back()->withInput();
        }
    }

    public function destroy(User $user)
    {
        $user->delete();
        $user->syncRoles([]);
        session()->flash('success','删除成功!');
    }

    public function userRole(User $userRole)
    {
//        var_dump($userRole);die;
        $roles = Role::all();
        return view('user.role',compact('userRole','roles'));
    }

    public function userRoleSave(Request $request,User $userRoleSave)
    {
//       var_dump($userRoleSave);die;
        $userRoleSave->update([
            'name'=>$request->name,
        ]);
        $userRoleSave->syncRoles($request->role);
        session()->flash('success','管理员权限修改成功');
        return redirect()->route('user.index');
    }
}
