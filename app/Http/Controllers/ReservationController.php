<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class ReservationController extends Controller
{
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'car_id' => 'required|exist:cars,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date'
        ]);
        
        $car = Car::findOrFail($request->car_id);

        //Lógica para prevenir conflictos con las fechas de reservas
        $conflict = Reservation::where('car_id', $car->id)
            ->where('status', '!=', 'canceled')
            ->where(function ($query) use ($request){
                $query->where('start_date', '<', $request->end_date)
                    ->where('end_date', '>', $request->start_date);
        })
        ->exists();

        if ($conflict) {
            return response()->json([
                'message' => 'El vehículo no está disponible para las fechas seleccionadas'
            ], 422);
        }

        //Calcular días

        $days = Carbon::parse($request->start_date)
        ->diffInDays(Carbon::parse($request->end_date));

        $total = $days * $car->price_per_day;

        $reservation = Reservation::create([
            'user_id' => auth()->id(),
            'car_id' => $car->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_price' => $total,
            'status' => 'pending'
        ]);

        return response()->json([
            'message' => 'Reserva creada correctamente',
            'reservation' => $reservation
        ]);
    }

    public function myReservations()
    {
        $reservations = Reservation::with(['car.brand'])
        ->where('user_id', auth()->id())
        ->latest()
        ->get();

        return response()->json($reservations);
    }

    public function index(Request $request)
    {
        $reservations = Reservation::with(['user', 'car.brand'])
            ->when($request->status, function ($query, $status){ 
                $query->where('status', $status);
            })
            ->when($request->user, function ($query, $user){
                $query->whereHas('user', function ($q) use ($user){
                    $q->where('name', 'like', "%{$user}%");
                });
            })
            ->when($request->car, function ($query, $car) {
                $query->whereHas('car', function ($q) use ($car) {
                    $q->where('model', 'like', "%{$car}%")
                    ->orWhereHas('brand', function ($brandQuery) use ($car) {
                        $brandQuery->where('name', 'like', "%{$car}%");
                    });
                });
            })
            ->latest()
            ->paginate(10);

        return response()->json($reservations);
    }

    public function confirm(Reservation $reservation)
    {
        if ($reservation->status !== Reservation::STATUS_PENDING) {
            return response()->json([
                'message' => 'Solo se pueden confirmar reservas pendientes'
            ]);
        }

        $reservation->update([
            'status' => Reservation::STATUS_CONFIRMED
        ]);

        return response()->json([
            'message' => 'Reserva Confirmada'
        ]);
    }

    public function cancel(Reservation $reservation)
    {
        if ($reservation->status === Reservation::STATUS_CANCELED){
            return response()->json([
                'message' => 'La reserva ya está cancelada'
            ], 422);
        }

        $reservation->update([
            'status' => Reservation::STATUS_CANCELED
        ]);

        return response()->json([
            'message' => "Reserva cancelada"
        ]);
    }

    public function userCancel(Reservation $reservation)
    {
        if($reservation->user_id !== auth()->id()){
            return response()->json([
                'message' => 'No autorizado'
            ], 403);
        }
        if ($reservation->status !== Reservation::STATUS_PENDING){
            return response()->json([
                'message' => 'Sólo se pueden cancelar las reservas pendientes'
            ], 422);
        }
        $reservation->update([
            'status' => Reservation::STATUS_CANCELED
        ]);

        return response()->json([
            'message' => 'Reserva cancelada correctamente'
        ]);
    }
    public function carReservations(Car $car)
    {
        $reservations = Reservation::where('car_id', $car->id)
            ->where('status', '!=', 'canceled')
            ->select('start_date', 'end_date', 'status')
            ->orderBy('start_date')
            ->get();

        return response()->json($reservations);
    }

    public function popularCars()
    {
        $cars = Reservation::with(['car.brand', 'car.category'])
            ->where('status', '!=', 'canceled')
            ->select('car_id',
            DB::raw('COUNT(*) as total_reservations'),
            DB::raw('SUM(total_price) as total_revenue')
        )
        ->groupBy('car_id')
        ->orderByDesc('total_reservations')
        ->limit(5)
        ->get()
        ->map(function ($item) {
            return [
                'id' => $item->car->id,
                'name' => $item->car->brand->name . ' ' . $item->car->model,
                'category' => $item->car->category->name ?? '-',
                'total_reservations' => $item->total_reservations,
                'total_revenue' => $item->total_revenue,
            ];
        });

        return response()->json($cars);
    }
}
