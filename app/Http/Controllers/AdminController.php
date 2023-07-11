<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function transaction()
    {
        $orders = Order::all();

        return view('myorders',['orders'=>$orders]);
    }

    public function editTransaction($id)
    {
        $order = Order::find($id);
        return view('edit-order', ['order' => $order]);
    }

    public function updateTransaction(Request $request, $id)
    {
        $request->validate([
            'payment_status' => 'required',
            'status' => 'required'
        ]);

        $order = Order::find($id);
        $order->payment_status = $request->payment_status;
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Transaction updated successfully.');
    }
}
