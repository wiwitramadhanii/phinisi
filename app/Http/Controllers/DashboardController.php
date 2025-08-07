<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        
        $today         = Carbon::today();
        $packages      = Package::select('id', 'package_name')->get();
        $totalPackages = Package::count();
        $todayBookings = Booking::with('package')
            ->whereDate('selected_date', $today)
            ->where('is_already_pay', 1)
            ->get();

       
        $totalRevenue        = Booking::where('is_already_pay', 1)->sum('total_price');
        $totalPaidCustomers  = Booking::where('is_already_pay', 1)->distinct('name')->count('name');
        $totalUnpaidCustomers= Booking::where('is_already_pay', 0)->distinct('name')->count('name');
        $todayPackagesCount  = $todayBookings->count();

        // Filters
        $filterMonth = $request->query('filter_month'); 
        $filterYear  = $request->query('filter_year');
        $packageId   = $request->query('package_id');

        $year  = now()->year;
        $month = now()->month;

        if ($filterMonth) {
            [$year, $month] = explode('-', $filterMonth);
        } elseif ($filterYear) {
            $year  = (int) $filterYear;
            $month = null;
        }

        // Revenue per package
        $revenueByPackage = Package::query()
            ->select('packages.id', 'packages.package_name', DB::raw('COALESCE(SUM(bookings.total_price), 0) as revenue'))
            ->leftJoin('bookings', function ($join) use ($year, $month) {
                $join->on('bookings.package_id', '=', 'packages.id')
                    ->where('bookings.is_already_pay', true)
                     ->whereYear('bookings.selected_date', $year);

                if ($month !== null) {
                    $join->whereMonth('bookings.selected_date', $month);
                }
            })
            ->groupBy('packages.id', 'packages.package_name')
            ->orderBy('packages.package_name')
            ->get();

        // Monthly revenue
        $monthlyRevenueDetailed = Booking::where('is_already_pay', 1)
            ->when($filterMonth, function ($q) use ($filterMonth) {
                $q->whereYear('selected_date', substr($filterMonth, 0, 4))
                  ->whereMonth('selected_date', substr($filterMonth, 5, 2));
            })
            ->when(!$filterMonth && $filterYear, fn($q) => $q->whereYear('selected_date', $filterYear))
            ->select([
                DB::raw("DATE_FORMAT(selected_date, '%Y-%m') as ym"),
                DB::raw('SUM(total_price) as revenue')
            ])
            ->groupBy('ym')
            ->orderBy('ym')
            ->pluck('revenue', 'ym')
            ->toArray();

        // Yearly revenue 
        $yearlyRevenue = Booking::where('is_already_pay', 1)
            ->select([
                DB::raw('YEAR(selected_date) as year'),
                DB::raw('SUM(total_price) as revenue')
            ])
            ->groupBy('year')
            ->orderBy('year')
            ->pluck('revenue', 'year')
            ->toArray();

        return view('dashboard', compact(
            'packages',
            'todayBookings',
            'totalPackages',
            'totalRevenue',
            'totalPaidCustomers',
            'totalUnpaidCustomers',
            'todayPackagesCount',
            'revenueByPackage',
            'monthlyRevenueDetailed',
            'yearlyRevenue',
            'filterMonth',
            'filterYear',
            'packageId'
        ));
    }
}
