<?php

namespace App\Http\Controllers;

use App\Model\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::paginate(10);
        return view('customer.index',compact('customers'));
    }

    public function show(Customer $customer)
    {
//        var_dump($customer);die;
        return view('customer.show',compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('customer.edit',compact('customer'));
    }

    public function update(Request $request,Customer $customer)
    {
        $customer->update([
            'status'=>$request->status??0,
        ]);
        session()->flash('success','禁用成功');
        return redirect()->route('customer.index');
    }
}
