<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Psy\Exception\RuntimeException;

class LoginController extends Controller
{
    public function show()
    {
        //判断用户是否在登录界面
        if (Auth::check()){
            return redirect()->route('user.index',[Auth::user()]);
        }
        return view('user.login');
    }

    public function store(Request $request)
    {
        //检验
        $this->validate($request,[
            'name'=>'required',
            'password'=>'required',
            'captcha'=>'required|captcha',
        ]);
        //检测成功,验证信息是否和数据库匹配
        if (Auth::attempt(['name'=>$request->name,'password'=>$request->password],$request->has('remember'))){
            //成功则提示并跳转
            session()->flash('success','登录成功!');
            return redirect()->route('user.index',[Auth::user()]);
        }else{
            //失败则提示并跳转
            session()->flash('warning','用户名或密码错误,登录失败!');
            return back()->withInput();
        }
    }

    public function destroy()
    {
        Auth::logout();
        //提示并退出
        session()->flash('success','您已安全退出!');
        return redirect()->route('login');
    }
}
