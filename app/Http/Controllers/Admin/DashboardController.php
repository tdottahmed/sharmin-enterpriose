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
    public function index(Request $request)
    {
        // Order Status Filtering
        $selectedYear = $request->input('order_status_year', date('Y'));
        $startOfYear = Carbon::create($selectedYear)->startOfYear();
        $endOfYear = Carbon::create($selectedYear)->endOfYear();

        $orderData = Order::selectRaw('MONTH(created_at) as month, status, SUM(total_amount) as total_amount')
            ->whereBetween('created_at', [$startOfYear, $endOfYear])
            ->groupBy('month', 'status')
            ->get();

        // Initialize data for order status chart
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
            $index = $order->month - 1; // Zero-based index
            $chartData[$order->status][$index] = $order->total_amount;
        }

        // Widget data
        $orders = Order::get();
        $widgetData = [
            'totalClients' => Client::count(),
            'totalOrdersAmount' => $orders->sum('total_amount'),
            'totalCompletedOrder' => $orders->where('status', 'completed')->count(),
            'totalPendingOrder' => $orders->where('status', 'pending')->count(),
            'totalCancelledOrder' => $orders->where('status', 'cancelled')->count(),
        ];

        // Profit Filtering
        $selectedProfitYear = $request->input('profit_year', date('Y'));
        $profitStartOfYear = Carbon::create($selectedProfitYear)->startOfYear();
        $profitEndOfYear = Carbon::create($selectedProfitYear)->endOfYear();

        $monthlyProfitData = Order::selectRaw('MONTH(created_at) as month, SUM(profit) as total_profit')
            ->whereBetween('created_at', [$profitStartOfYear, $profitEndOfYear])
            ->groupBy('month')
            ->get();

        // Initialize data for profit chart
        $profitChartData = [
            'categories' => [],
            'profit' => array_fill(0, 12, 0),
        ];

        foreach (range(1, 12) as $month) {
            $profitChartData['categories'][] = Carbon::create()->month($month)->format('F');
        }

        foreach ($monthlyProfitData as $profit) {
            $index = $profit->month - 1; // Zero-based index
            $profitChartData['profit'][$index] = $profit->total_profit;
        }

        return view('admin.dashboard.index', compact('chartData', 'widgetData', 'profitChartData', 'selectedYear', 'selectedProfitYear'));
    }
}
