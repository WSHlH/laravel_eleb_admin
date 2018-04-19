<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

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
        session()->flash('success','注册成功!');
        return redirect()->route('user.index');
    }

    public function edit(User $user)
    {

    }
}
