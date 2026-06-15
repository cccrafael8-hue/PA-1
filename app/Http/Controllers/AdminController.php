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

        // Fetch all orders and reservasis to group them in PHP (including soft-deleted)
        $orders = Order::withTrashed()->select('created_at', 'total')->orderBy('created_at', 'ASC')->get();
        $reservasisData = Reservasi::withTrashed()->select('created_at', 'total_bayar')->where('status', 'paid')->orderBy('created_at', 'ASC')->get();
        
        $grouped = [];

        $processData = function($items, $amountField) use (&$grouped, $filter) {
            foreach ($items as $item) {
                $date = Carbon::parse($item->created_at);
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
                $grouped[$key]['total'] += $item->$amountField;
            }
        };

        $processData($orders, 'total');
        $processData($reservasisData, 'total_bayar');

        // Sort by key to ensure chronological order after combining both datasets
        ksort($grouped);

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

    public function export()
    {
        $fileName = 'statistik_penjualan_' . date('Y-m-d') . '.csv';

        // Fetch orders and paid reservations (including soft-deleted)
        $orders = Order::withTrashed()->orderBy('created_at', 'ASC')->get();
        $reservasis = Reservasi::withTrashed()->where('status', 'paid')->orderBy('created_at', 'ASC')->get();

        $data = [];

        foreach ($orders as $order) {
            $data[] = [
                'Tanggal' => Carbon::parse($order->created_at)->format('Y-m-d H:i:s'),
                'Tipe' => 'Order',
                'Nama Pelanggan' => $order->nama,
                'Detail' => $order->menu,
                'Total' => $order->total,
            ];
        }

        foreach ($reservasis as $reservasi) {
            $data[] = [
                'Tanggal' => Carbon::parse($reservasi->created_at)->format('Y-m-d H:i:s'),
                'Tipe' => 'Reservasi',
                'Nama Pelanggan' => $reservasi->nama,
                'Detail' => 'Reservasi untuk ' . $reservasi->jumlah_orang . ' orang',
                'Total' => $reservasi->total_bayar,
            ];
        }

        // Sort data by Tanggal ascending
        usort($data, function($a, $b) {
            return strtotime($a['Tanggal']) - strtotime($b['Tanggal']);
        });

        return response()->streamDownload(function () use ($data) {
            $file = fopen('php://output', 'w');
            // Add BOM to fix UTF-8 encoding in Excel
            fputs($file, chr(0xEF) . chr(0xBB) . chr(0xBF));
            
            fputcsv($file, ['Tanggal', 'Tipe', 'Nama Pelanggan', 'Detail', 'Total']);
            
            foreach ($data as $row) {
                fputcsv($file, [
                    $row['Tanggal'],
                    $row['Tipe'],
                    $row['Nama Pelanggan'],
                    $row['Detail'],
                    $row['Total']
                ]);
            }
            
            fclose($file);
        }, $fileName);
    }
}