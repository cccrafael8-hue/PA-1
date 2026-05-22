<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservasi;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $reservasis = Reservasi::all();
        $filter = $request->query('filter', 'day'); // default to day

        // Fetch all orders to group them in PHP (robust and DB agnostic for small-medium datasets)
        $orders = Order::select('created_at', 'total')->orderBy('created_at', 'ASC')->get();
        $grouped = [];

        foreach ($orders as $order) {
            $date = Carbon::parse($order->created_at);
            if ($filter == 'week') {
                $key = $date->format('Y-W');
                $label = 'Minggu ' . $date->format('W, Y');
            } elseif ($filter == 'month') {
                $key = $date->format('Y-m');
                $label = $date->format('M Y');
            } elseif ($filter == 'year') {
                $key = $date->format('Y');
                $label = $date->format('Y');
            } else {
                // day
                $key = $date->format('Y-m-d');
                $label = $date->format('d M Y');
            }
            
            if (!isset($grouped[$key])) {
                $grouped[$key] = [
                    'label' => $label,
                    'total' => 0
                ];
            }
            $grouped[$key]['total'] += $order->total;
        }

        // Determine how many latest data points to show
        $limit = 30; // default for day
        if ($filter == 'week') $limit = 12;
        if ($filter == 'month') $limit = 12;
        if ($filter == 'year') $limit = 5;

        // Take only the last $limit items
        $sliced = array_slice($grouped, -$limit);

        $chartDates = [];
        $chartTotals = [];

        foreach ($sliced as $item) {
            $chartDates[] = $item['label'];
            $chartTotals[] = $item['total'];
        }

        return view('admin.dashboard', compact('reservasis', 'chartDates', 'chartTotals', 'filter'));
    }
}