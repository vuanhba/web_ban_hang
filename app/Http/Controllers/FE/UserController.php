<?php

namespace App\Http\Controllers\FE;

use Hash;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $listOrder = Order::where('user_id', auth()->id())->get();
        $user = auth()->user();
        return view('fe.user.index',compact('listOrder','user'));
    }
    public function orderDetail($id)
    {
        $orderDetail = Order::find($id)->OrderDetail->load('product');
      
        return view('fe.user.index',compact('orderDetail'));
        
    }
    public function changePasssword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed',
        ]);
        $user = auth()->user();
        if(!Hash::check($request->old_password, $user->password)){
            return redirect()->back()->with('error','Old password is incorrect');
        }
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->back()->with('success','Change password success');

    }
   
}
