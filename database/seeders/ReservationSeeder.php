<?php

namespace Database\Seeders;

use App\Models\Reservation;
use App\Models\Car;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ReservationSeeder extends Seeder
{
    public function run(): void
    {
        $cars = Car::where('is_active', true)->get();
        $userId = 1;
        $today = Carbon::today();

        $statuses = [
            ['status' => Reservation::STATUS_PENDING, 'count' => 13],
            ['status' => Reservation::STATUS_CONFIRMED, 'count' => 13],
            ['status' => Reservation::STATUS_CANCELED, 'count' => 12],
            ['status' => Reservation::STATUS_COMPLETED, 'count' => 12],
        ];

        $carIndex = 0;
        $totalCars = $cars->count();

        foreach ($statuses as $statusGroup) {
            $status = $statusGroup['status'];
            $count = $statusGroup['count'];

            for ($i = 0; $i < $count; $i++) {
                $car = $cars[$carIndex % $totalCars];
                $carIndex++;

                $dateType = $i % 3;

                if ($dateType === 0) {
                    $daysOffset = rand(-60, -1);
                    $startDate = $today->copy()->addDays($daysOffset);
                    $duration = rand(1, 7);
                    $endDate = $startDate->copy()->addDays($duration);
                } elseif ($dateType === 1) {
                    $daysOffset = rand(0, 2);
                    $startDate = $today->copy()->addDays($daysOffset);
                    $duration = rand(1, 7);
                    $endDate = $startDate->copy()->addDays($duration);
                } else {
                    $daysOffset = rand(3, 60);
                    $startDate = $today->copy()->addDays($daysOffset);
                    $duration = rand(1, 7);
                    $endDate = $startDate->copy()->addDays($duration);
                }

                $days = $startDate->diffInDays($endDate);
                $days = $days > 0 ? $days : 1;
                $totalPrice = $days * $car->price_per_day;

                Reservation::create([
                    'user_id' => $userId,
                    'car_id' => $car->id,
                    'start_date' => $startDate->toDateString(),
                    'end_date' => $endDate->toDateString(),
                    'total_price' => $totalPrice,
                    'status' => $status,
                ]);
            }
        }
    }
}
