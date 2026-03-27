<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $today = Carbon::today();

        $totalReservations = Reservation::count();

        $activeReservations = Reservation::whereIn('status', [
            Reservation::STATUS_PENDING,
            Reservation::STATUS_CONFIRMED
        ])->count();

        $completedReservations = Reservation::where('status', Reservation::STATUS_COMPLETED)->count();

        $totalRevenue = Reservation::where('status', Reservation::STATUS_COMPLETED)
        ->sum('total_price');

        $expectedRevenue = Reservation::whereIn('status', [
            Reservation::STATUS_COMPLETED,
            Reservation::STATUS_CONFIRMED,
        ])->sum('total_price');

        $carsInUse = Reservation::where('status', Reservation::STATUS_CONFIRMED)
        ->whereDate('start_date', '<=', $today)
        ->whereDate('end_date', '>=', $today)
        ->count();

        return response()->json([
        'total_reservations' => $totalReservations,
        'active_reservations' => $activeReservations,
        'completed_reservations' => $completedReservations,
        'total_revenue' => $totalRevenue,
        'expected_revenue' => $expectedRevenue,
        'cars_in_use' => $carsInUse
    ]);
    }
    public function stats()
    {

        $monthlyRevenue = Reservation::select(
            DB::raw('EXTRACT(MONTH FROM start_date) as month'),
            DB::raw('SUM(total_price) as revenue')
        )
        ->whereIn('status', ['confirmed', 'completed'])
        ->groupBy(DB::raw('EXTRACT(MONTH FROM start_date)'))
        ->orderBy(DB::raw('EXTRACT(MONTH FROM start_date)'))
        ->get();

        $months = [
            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr',
            5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug',
            9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec'
        ];

        $monthlyRevenue = $monthlyRevenue->map(function ($item) use ($months) {
            $monthNumber = (int) $item->month;

            return [
                'month' => $months[$monthNumber],
                'revenue' => $item->revenue
            ];
        });
    }

    public function reservationsByStatus()
    {
        $data = Reservation::select('status', DB::raw('count(*) as total'))
        ->groupBy('status')
        ->get();

    return response()->json($data);
    }

}
