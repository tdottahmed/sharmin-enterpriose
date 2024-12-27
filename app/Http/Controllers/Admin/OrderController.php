<?php

namespace App\Http\Controllers\Admin;

use Mpdf\Mpdf;
use App\Models\Order;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Http\Requests\Admin\OrderRequest;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view orders')->only('index');
        $this->middleware('permission:create orders')->only(['create', 'store']);
        $this->middleware('permission:update orders')->only(['edit', 'update']);
        $this->middleware('permission:delete orders')->only('destroy');
    }

    public function index()
    {
        if (request()->has('search')) {
            $searchQuery = request('search');
            $orders = Order::where('order_no', 'like', "%{$searchQuery}%")
                ->orWhere('status', 'like', "%{$searchQuery}%")
                ->orWhereHas('client', function ($query) use ($searchQuery) {
                    $query->where('name', 'like', "%{$searchQuery}%");
                })
                ->latest()
                ->get();
        } elseif (request('status') == 'pending' || request('status') == 'completed' || request('status') == 'cancelled') {
            $orders = Order::where('status', request('status'))->latest()->get();
        } else {
            $orders = Order::latest()->get();
        }
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new order.
     *
     * @return \Illuminate\View\View
     */

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
            dd($th->getMessage());
            Log::error('Order creation failed: ' . $th->getMessage());
            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $clients = Client::all();
        return view('admin.orders.edit', compact('order', 'clients'));
    }

    public function update(OrderRequest $request, Order $order)
    {
        try {
            $request->handle($order);
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

    public function complete(Order $order)
    {
        try {
            $order->status = 'completed';
            $order->save();
            return redirect()->route('orders.index')->with('success', 'Order completed successfully');
        } catch (\Throwable $th) {
            Log::error('Order completion failed: ' . $th->getMessage());
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function cancel(Order $order)
    {
        try {
            $order->status = 'cancelled';
            $order->save();
            return redirect()->route('orders.index')->with('success', 'Order cancelled successfully');
        } catch (\Throwable $th) {
            Log::error('Order cancellation failed: ' . $th->getMessage());
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function generatePdf(Order $order)
    {
        $logoPath = getFilePath(getSetting('app_logo'));
        $html = View::make('admin.orders.pdf', compact('order', 'logoPath'))->render();
        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);
        return response($mpdf->Output('order.pdf', \Mpdf\Output\Destination::INLINE))
            ->header('Content-Type', 'application/pdf');
    }
}
