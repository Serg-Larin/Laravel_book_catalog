<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::all();
        return view('admin.order.index',compact('orders'));
    }

    public function oneOrder($id){
        $order = Order::find($id);
        return view('admin.order.one', compact('order'));
    }

    public function orderStatusUpdate($id){
        $order = Order::find($id);
        if($order){
            $order->status = Order::STATUS_PROCESSED;
            if($order->save()){
                return redirect()->route('order.index')->with('success',true);
            }
        }
        redirect()->back();
    }


    public function newOrder(Request $request){
        $requestData = $request->all();
        $validate = Validator::make($requestData,
            [
                'book_id'=>['required','int','exists:books,id'],
                'phone'=>['required','numeric','phone'],
                'name'=>['required','string','min:3'],
                'email'=>['required','email'],
            ]);
        if($validate->fails()){
            return response()->json(['err'=>$validate->getMessageBag()->first()]);
        }
        $is_saved = Order::createNew($requestData['book_id'],
                                     $requestData['email'],
                                     $requestData['phone'],
                                     $requestData['name']);
        return response()->json(['is_saved'=>$is_saved]);
    }
}
