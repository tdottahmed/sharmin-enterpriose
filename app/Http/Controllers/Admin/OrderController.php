<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OrderRequest;
use App\Models\Client;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('admin.orders.index', compact('orders'));
    }

    public function create()
    {
        $clients = Client::all();
        return view('admin.orders.create', compact('clients'));
    }

    public function store(OrderRequest $request)
    {
        try {
            $request->handle();
            return redirect()->route('orders.index')->with('success', 'Order created successfully');
        } catch (\Throwable $th) {
            Log::error('Order creation failed: ' . $th->getMessage());
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
    public function show()
    {
        return view('admin.orders.show');
    }
    public function edit()
    {
        return view('admin.orders.edit');
    }

    public function update(OrderRequest $request)
    {
        try {
            $request->handle();
            return redirect()->route('orders.index')->with('success', 'Order updated successfully');
        } catch (\Throwable $th) {
            Log::error('Order update failed: ' . $th->getMessage());
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function destroy(Order $order)
    {
        try {
            $order->delete();
            return redirect()->route('orders.index')->with('success', 'Order deleted successfully');
        } catch (\Throwable $th) {
            Log::error('Order deletion failed: ' . $th->getMessage());
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
