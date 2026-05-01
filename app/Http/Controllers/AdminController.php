<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservasi;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        $reservasis = Reservasi::all();

        // Get daily revenue from Orders
        $revenues = Order::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total) as total_revenue')
            )
            // ->where('status', 'Selesai') // Uncomment this if you only want to count completed orders
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->limit(30) // Last 30 days of data
            ->get();

        $chartDates = [];
        $chartTotals = [];

        foreach ($revenues as $revenue) {
            $chartDates[] = Carbon::parse($revenue->date)->format('d M Y');
            $chartTotals[] = $revenue->total_revenue;
        }

        return view('admin.dashboard', compact('reservasis', 'chartDates', 'chartTotals'));
    }
}