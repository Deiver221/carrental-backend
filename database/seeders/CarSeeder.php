<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    public function run(): void
    {
        $brands = Brand::all();
        $categories = Category::all();

        $cars = [
            ['brand' => 'Toyota', 'category' => 'Sedan', 'model' => 'Corolla', 'year' => 2024, 'price' => 45.00, 'transmission' => 'automatic', 'fuel_type' => 'gasoline', 'seats' => 5, 'image' => 'corolla1.png'],
            ['brand' => 'Toyota', 'category' => 'SUV', 'model' => 'RAV4', 'year' => 2024, 'price' => 75.00, 'transmission' => 'automatic', 'fuel_type' => 'gasoline', 'seats' => 5, 'image' => 'https://motormagazine.com.ar/wp-content/uploads/2020/06/Toyota-RAV4-2019-1-696x464.jpg'],
            ['brand' => 'Honda', 'category' => 'Sedan', 'model' => 'Civic', 'year' => 2023, 'price' => 50.00, 'transmission' => 'automatic', 'fuel_type' => 'gasoline', 'seats' => 5, 'image' => 'civic3.png'],
            ['brand' => 'Honda', 'category' => 'SUV', 'model' => 'CR-V', 'year' => 2024, 'price' => 80.00, 'transmission' => 'automatic', 'fuel_type' => 'hybrid', 'seats' => 5, 'image' => 'crv1.png'],
            ['brand' => 'Ford', 'category' => 'Pick-Up', 'model' => 'F-150', 'year' => 2023, 'price' => 95.00, 'transmission' => 'automatic', 'fuel_type' => 'gasoline', 'seats' => 6, 'image' => 'raptor1.jpg'],
            ['brand' => 'Ford', 'category' => 'SUV', 'model' => 'Explorer', 'year' => 2024, 'price' => 85.00, 'transmission' => 'automatic', 'fuel_type' => 'gasoline', 'seats' => 7, 'image' => 'cherokee1.jpg'],
            ['brand' => 'BMW', 'category' => 'Deportivo', 'model' => 'M3', 'year' => 2024, 'price' => 180.00, 'transmission' => 'automatic', 'fuel_type' => 'gasoline', 'seats' => 4, 'image' => 'm4_2.png'],
            ['brand' => 'BMW', 'category' => 'SUV', 'model' => 'X5', 'year' => 2024, 'price' => 120.00, 'transmission' => 'automatic', 'fuel_type' => 'diesel', 'seats' => 5, 'image' => 'cross3.png'],
            ['brand' => 'Mercedes-Benz', 'category' => 'Sedan', 'model' => 'C-Class', 'year' => 2024, 'price' => 110.00, 'transmission' => 'automatic', 'fuel_type' => 'gasoline', 'seats' => 5, 'image' => 'audiq3.png'],
            ['brand' => 'Mercedes-Benz', 'category' => 'SUV', 'model' => 'GLE', 'year' => 2024, 'price' => 130.00, 'transmission' => 'automatic', 'fuel_type' => 'diesel', 'seats' => 5, 'image' => 'Qashqai.png'],
            ['brand' => 'Audi', 'category' => 'Sedan', 'model' => 'A4', 'year' => 2023, 'price' => 95.00, 'transmission' => 'automatic', 'fuel_type' => 'gasoline', 'seats' => 5, 'image' => 'q5_2.png'],
            ['brand' => 'Audi', 'category' => 'SUV', 'model' => 'Q5', 'year' => 2024, 'price' => 115.00, 'transmission' => 'automatic', 'fuel_type' => 'gasoline', 'seats' => 5, 'image' => 'q5_3.png'],
            ['brand' => 'Nissan', 'category' => 'Sedan', 'model' => 'Altima', 'year' => 2023, 'price' => 48.00, 'transmission' => 'automatic', 'fuel_type' => 'gasoline', 'seats' => 5, 'image' => 'versa1.png'],
            ['brand' => 'Nissan', 'category' => 'SUV', 'model' => 'Pathfinder', 'year' => 2024, 'price' => 78.00, 'transmission' => 'automatic', 'fuel_type' => 'gasoline', 'seats' => 7, 'image' => 'gtr1.png'],
            ['brand' => 'Hyundai', 'category' => 'Hatchback', 'model' => 'Elantra', 'year' => 2024, 'price' => 38.00, 'transmission' => 'manual', 'fuel_type' => 'gasoline', 'seats' => 5, 'image' => 'toyotachr.png'],
            ['brand' => 'Hyundai', 'category' => 'SUV', 'model' => 'Tucson', 'year' => 2024, 'price' => 65.00, 'transmission' => 'automatic', 'fuel_type' => 'gasoline', 'seats' => 5, 'image' => 'citroenc3.webp'],
            ['brand' => 'Kia', 'category' => 'Sedan', 'model' => 'K5', 'year' => 2024, 'price' => 42.00, 'transmission' => 'automatic', 'fuel_type' => 'gasoline', 'seats' => 5, 'image' => 'versa3.png'],
            ['brand' => 'Kia', 'category' => 'Van', 'model' => 'Carnival', 'year' => 2024, 'price' => 72.00, 'transmission' => 'automatic', 'fuel_type' => 'gasoline', 'seats' => 8, 'image' => 'peugeot-3008.png'],
            ['brand' => 'Mitsubishi', 'category' => 'SUV', 'model' => 'Outlander', 'year' => 2023, 'price' => 55.00, 'transmission' => 'automatic', 'fuel_type' => 'hybrid', 'seats' => 5, 'image' => 'l200.jpg'],
            ['brand' => 'Chevrolet', 'category' => 'Pick-Up', 'model' => 'Silverado', 'year' => 2024, 'price' => 90.00, 'transmission' => 'automatic', 'fuel_type' => 'gasoline', 'seats' => 6, 'image' => 'tacoma1.png'],
        ];

        foreach ($cars as $carData) {
            $brand = $brands->firstWhere('name', $carData['brand']);
            $category = $categories->firstWhere('name', $carData['category']);

            Car::create([
                'brand_id' => $brand->id,
                'category_id' => $category->id,
                'model' => $carData['model'],
                'year' => $carData['year'],
                'price_per_day' => $carData['price'],
                'transmission' => $carData['transmission'],
                'fuel_type' => $carData['fuel_type'],
                'seats' => $carData['seats'],
                'description' => "{$carData['brand']} {$carData['model']} {$carData['year']} - {$carData['category']} con transmisión {$carData['transmission']} y combustible {$carData['fuel_type']}.",
                'is_active' => true,
                'image' => $carData['image'],
            ]);
        }
    }
}
