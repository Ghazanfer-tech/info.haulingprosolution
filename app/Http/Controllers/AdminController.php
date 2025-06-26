<?php

namespace App\Http\Controllers;
use App\Models\Order;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    function index()
    {
        return view('admin.master');
    }

    function destroyOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('admin-orders-index');
    }
}
