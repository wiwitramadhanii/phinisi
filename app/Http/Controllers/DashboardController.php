<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Booking;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $packages = Package::select('id', 'package_name')->get();
        $todayBookings = Booking::with('package') ->whereDate('selected_date', Carbon::today()) ->where('is_already_pay', 1) ->get();
        $todayPackagesCount = $todayBookings->count();
        $totalPackages = Package::count();
        // Total pendapatan (hanya yang sudah dibayar)
        $totalRevenue = Booking::where('is_already_pay', 1)->sum('total_price');

        // Total pelanggan unik yang sudah membayar
        $totalPaidCustomers = Booking::where('is_already_pay', 1)
            ->distinct('name')
            ->count('name');
        
        $totalUnpaidCustomers = Booking::where('is_already_pay', 0) ->distinct('name')->count('name');

        // Pendapatan per paket
        $packageId      = $request->query('package_id');
        $filterMonth = $request->query('filter_month');
        $filterYear  = $request->query('filter_year');

        $now   = Carbon::now();
        $month          = now()->month;
        $year           = now()->year;

        if ($filterMonth) {
            [$y, $m] = explode('-', $filterMonth);
            $year  = (int) $y;
            $month = (int) $m;
        }
        elseif ($filterYear) {
            $year  = (int) $filterYear;
            $month = null;
        }
        $allPackages    = Package::orderBy('package_name')->get();
        $revenueByPackage = Package::select(
            'packages.id',
            'packages.package_name',
            DB::raw('COALESCE(SUM(bookings.total_price), 0) as revenue')
            )
            ->leftJoin('bookings', function($join) use ($year, $month) {
                $join->on('bookings.package_id', '=', 'packages.id')
                     ->whereYear('bookings.selected_date', $year);
    
                if ($month) {
                    $join->whereMonth('bookings.selected_date', $month);
                }
            })
            ->when($packageId, fn($q) => $q->where('packages.id', $packageId))
            ->groupBy('packages.id', 'packages.package_name')
            ->get();

        // Pendapatan bulanan (format: [month => revenue])
        $monthlyQuery = Booking::where('is_already_pay', 1)
            ->when($packageId, fn($q) => $q->where('package_id', $packageId))
            ->when($filterMonth, function($q) use ($filterMonth) {
                $q->whereYear('selected_date', substr($filterMonth, 0, 4))
                ->whereMonth('selected_date', substr($filterMonth, 5, 2));
            })
            ->when(!$filterMonth && $filterYear, fn($q) => 
                $q->whereYear('selected_date', $filterYear)
            );
            $monthlyRevenueDetailed = $monthlyQuery
                ->select([
                    DB::raw("DATE_FORMAT(selected_date, '%Y-%m') as ym"),
                    DB::raw('SUM(total_price) as revenue')
                ])
                ->groupBy('ym')
                ->orderBy('ym')
                ->pluck('revenue', 'ym')
                ->toArray();
        
        // Pendapatan per tahun (format: [year => revenue])
        $yearlyRevenue = Booking::select(
                DB::raw('YEAR(selected_date) as year'),
                DB::raw('SUM(total_price) as revenue')
            )
            ->where('is_already_pay', 1)
            ->groupBy('year')
            ->orderBy('year')
            ->pluck('revenue', 'year')
            ->toArray();

        return view('dashboard', compact(
            'packageId',
            'allPackages',
            'packages',
            'todayPackagesCount',
            'todayBookings',
            'totalPackages',
            'totalRevenue',
            'totalUnpaidCustomers',
            'totalPaidCustomers',
            'revenueByPackage',
            'monthlyRevenueDetailed',
            'yearlyRevenue',
            'filterMonth',
            'filterYear'
        ));
    }
}
