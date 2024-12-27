<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $startOfYear = Carbon::now()->startOfYear();
        $endOfYear = Carbon::now()->endOfYear();

        $orderData = Order::selectRaw('MONTH(created_at) as month, status, SUM(total_amount) as total_amount')
            ->whereBetween('created_at', [$startOfYear, $endOfYear])
            ->groupBy('month', 'status')
            ->get();

        // Initialize data for all months and statuses
        $chartData = [
            'categories' => [],
            'pending' => array_fill(0, 12, 0),
            'completed' => array_fill(0, 12, 0),
            'cancelled' => array_fill(0, 12, 0),
        ];

        foreach (range(1, 12) as $month) {
            $chartData['categories'][] = Carbon::create()->month($month)->format('F');
        }

        foreach ($orderData as $order) {
            $index = $order->month - 1; // Zero-based index for array
            $chartData[$order->status][$index] = $order->total_amount;
        }
        $orders = Order::get();
        $widgetData = [
            'totalClients' => Client::count(),
            'totalOrdersAmount' => $orders->sum('total_amount'),
            'totalCompletedOrder' => $orders->where('status', 'completed')->count(),
            'totalPendingOrder' => $orders->where('status', 'pending')->count(),
            'totalCancelledOrder' => $orders->where('status', 'cancelled')->count(),
        ];
        return view('admin.dashboard.index', compact('chartData', 'widgetData'));
    }
}
