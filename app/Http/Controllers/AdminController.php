<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $reservations = Reservation::all();

        // Metric calculations
        $today = Carbon::today();
        
        $pendapatanOrder = Order::whereDate('created_at', $today)->where('status', 'selesai')->sum('total');
        $pendapatanReservasi = Reservation::whereDate('created_at', $today)->where('status', 'paid')->sum('total_price');
        $pendapatanHariIni = $pendapatanOrder + $pendapatanReservasi;

        $totalPesanan = Order::whereDate('created_at', $today)->where('is_hidden', false)->count();
        $pesananBelumKonfirmasi = Order::where('status', 'pending')->where('is_hidden', false)->count();
        
        $reservasiAktif = Reservation::whereIn('status', ['pending', 'paid'])->whereDate('date', '>=', $today)->count();
        $reservasiHariIni = Reservation::whereDate('date', $today)->whereIn('status', ['pending', 'paid'])->count();
        
        $ulasanBaru = \App\Models\Review::whereNull('admin_reply')->count();

        // Chart calculations
        $orders = Order::withTrashed()->where('status', 'selesai')->select('created_at', 'total')->orderBy('created_at', 'ASC')->get();
        $reservationsData = Reservation::withTrashed()->select('created_at', 'total_price')->where('status', 'paid')->orderBy('created_at', 'ASC')->get();

        $getChartData = function($filterType) use ($orders, $reservationsData) {
            $grouped = [];
            $processData = function($items, $amountField) use (&$grouped, $filterType) {
                foreach ($items as $item) {
                    $date = Carbon::parse($item->created_at);
                    if ($filterType == 'week') {
                        $key = $date->format('Y-W');
                        $label = 'Minggu ' . $date->format('W, Y');
                    } elseif ($filterType == 'month') {
                        $key = $date->format('Y-m');
                        $label = $date->format('M Y');
                    } elseif ($filterType == 'year') {
                        $key = $date->format('Y');
                        $label = $date->format('Y');
                    } else {
                        // day
                        $key = $date->format('Y-m-d');
                        $label = $date->format('d M Y');
                    }
                    if (!isset($grouped[$key])) {
                        $grouped[$key] = ['label' => $label, 'total' => 0];
                    }
                    $grouped[$key]['total'] += $item->$amountField;
                }
            };

            $processData($orders, 'total');
            $processData($reservationsData, 'total_price');
            ksort($grouped);

            $limit = 30;
            if ($filterType == 'week') $limit = 12;
            if ($filterType == 'month') $limit = 12;
            if ($filterType == 'year') $limit = 5;

            $sliced = array_slice($grouped, -$limit);
            $chartDates = [];
            $chartTotals = [];
            foreach ($sliced as $item) {
                $chartDates[] = $item['label'];
                $chartTotals[] = $item['total'];
            }
            return [$chartDates, $chartTotals];
        };

        list($chartDates, $chartTotals) = $getChartData('day');
        list($chartDatesWeek, $chartTotalsWeek) = $getChartData('week');
        list($chartDatesMonth, $chartTotalsMonth) = $getChartData('month');
        list($chartDatesYear, $chartTotalsYear) = $getChartData('year');

        return view('admin.dashboard', compact(
            'reservations',
            'pendapatanHariIni',
            'totalPesanan',
            'pesananBelumKonfirmasi',
            'reservasiAktif',
            'reservasiHariIni',
            'ulasanBaru',
            'chartDates', 'chartTotals',
            'chartDatesWeek', 'chartTotalsWeek',
            'chartDatesMonth', 'chartTotalsMonth',
            'chartDatesYear', 'chartTotalsYear'
        ));
    }

    public function export()
    {
        $fileName = 'statistik_penjualan_' . date('Y-m-d') . '.csv';

        $orders = Order::withTrashed()->where('status', 'selesai')->orderBy('created_at', 'ASC')->get();
        $reservations = Reservation::withTrashed()->where('status', 'paid')->orderBy('created_at', 'ASC')->get();

        $data = [];

        foreach ($orders as $order) {
            $data[] = [
                'Tanggal' => Carbon::parse($order->created_at)->format('Y-m-d H:i:s'),
                'Tipe' => 'Order',
                'Nama Pelanggan' => $order->name,
                'Detail' => $order->items,
                'Total' => $order->total,
            ];
        }

        foreach ($reservations as $reservasi) {
            $data[] = [
                'Tanggal' => Carbon::parse($reservasi->created_at)->format('Y-m-d H:i:s'),
                'Tipe' => 'Reservasi',
                'Nama Pelanggan' => $reservasi->name,
                'Detail' => 'Reservasi untuk ' . $reservasi->guest_count . ' orang',
                'Total' => $reservasi->total_price,
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