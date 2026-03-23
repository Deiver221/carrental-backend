<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCarRequest;
use App\Models\Car;
use Illuminate\Http\Request;




class CarController extends Controller
{


    public function store(StoreCarRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')){
            $path = $request->file('image')->store('cars', 'public');
            $data['image'] = $path;
        }
        $car = Car::create($data);
        
        return response()->json([
            'message' => 'Vehiculo publicado correctamente',
            'car' => $car
        ], 201);
    }

    public function index(Request $request)
    {
        $cars = Car::with(['brand', 'category'])
            ->when($request->search, function ($query, $search) {
                $query->where('model', 'like', "%{$search}%")
                    ->orWhereHas('brand', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })
            ->when($request->brand, function ($query, $brand) {
                $query->where('brand_id', $brand);
            })
            ->when($request->category, function ($query, $category) {
                $query->where('category_id', $category);
            })
            ->latest()
            ->paginate(10);

        return response()->json($cars);
    }

    public function destroy($id)
    {
        $car = Car::findOrFail($id);

        $car->delete();

        return response()->json([
            'message' => 'Vehiculo eliminado correctamente'
        ]);
    }

    public function update(StoreCarRequest $request, Car $car)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('cars', 'public');

            $data['image'] = $path;   
        }

        $car->update($data);

        return response()->json([
            'message' => 'Vehículo actualizado correctamente',
            'car' => $car
        ]);

    }

    public function show($id)
    {
        $car = Car::with(['brand', 'category'])->findOrFail($id);

        return response()->json($car);
    }

    public function publicCars(Request $request)
    {
       $cars = Car::with(['brand', 'category'])
        ->where('is_active', true)

        ->when($request->search, function ($query, $search) {
            $query->where('model', 'like', "%{$search}%")
                ->orWhereHas('brand', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
          });
        })

        ->when($request->brand, function ($query, $brand) {
            $query->where('brand_id', $brand);
        })

        ->when($request->category, function ($query, $category) {
            $query->where('category_id', $category);
        })

        ->latest()
        ->paginate(9);

    return response()->json($cars);
    }

    public function showPublic(Car $car)
    {
        return $car->load(['brand', 'category']);
    }
    public function toggleActive(Car $car)
    {
        $car->update(['is_active' => !$car->is_active]);

        return response()->json([
            'message' => 'Estado actualizado',
            'is_active' => $car->is_active
        ]);
    }
}
