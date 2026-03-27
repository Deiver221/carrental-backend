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
            ['brand' => 'Toyota', 'category' => 'Sedan', 'model' => 'Corolla', 'year' => 2024, 'price' => 45.00, 'transmission' => 'automatic', 'fuel_type' => 'gasoline', 'seats' => 5, 'image' => 'https://autotest.com.ar/wp-content/uploads/2021/02/TOYOTA-COROLLA-GR-S-7.jpg'],
            ['brand' => 'Toyota', 'category' => 'SUV', 'model' => 'RAV4', 'year' => 2024, 'price' => 75.00, 'transmission' => 'automatic', 'fuel_type' => 'gasoline', 'seats' => 5, 'image' => 'https://motormagazine.com.ar/wp-content/uploads/2020/06/Toyota-RAV4-2019-1-696x464.jpg'],
            ['brand' => 'Honda', 'category' => 'Sedan', 'model' => 'Civic', 'year' => 2023, 'price' => 50.00, 'transmission' => 'automatic', 'fuel_type' => 'gasoline', 'seats' => 5, 'image' => 'https://www.usnews.com/object/image/0000019b-0a10-d67d-afdb-4b3f41b70000/usn-2026-honda-civic-hatchback-sport-angular-front.JPG?update-time=1765400395305&size=responsiveGallery&format=webp'],
            ['brand' => 'Honda', 'category' => 'SUV', 'model' => 'CR-V', 'year' => 2024, 'price' => 80.00, 'transmission' => 'automatic', 'fuel_type' => 'hybrid', 'seats' => 5, 'image' => 'https://cdn.motor1.com/images/mgl/1ZE6EL/626:0:3761:2821/honda-cr-v-e-phev-advance-tech-4x2.webp'],
            ['brand' => 'Ford', 'category' => 'Pick-Up', 'model' => 'F-150', 'year' => 2023, 'price' => 95.00, 'transmission' => 'automatic', 'fuel_type' => 'gasoline', 'seats' => 6, 'image' => 'https://www.insidehook.com/wp-content/uploads/2023/10/ford-f-150-raptor-r-review.jpg?fit=1200%2C800'],
            ['brand' => 'Ford', 'category' => 'SUV', 'model' => 'Explorer', 'year' => 2024, 'price' => 85.00, 'transmission' => 'automatic', 'fuel_type' => 'gasoline', 'seats' => 7, 'image' => 'https://autotest.com.ar/wp-content/uploads/2024/11/Jeep-Grand-Cherokee-frente-1.jpg'],
            ['brand' => 'BMW', 'category' => 'Deportivo', 'model' => 'M3', 'year' => 2024, 'price' => 180.00, 'transmission' => 'automatic', 'fuel_type' => 'gasoline', 'seats' => 4, 'image' => 'https://di-uploads-pod23.dealerinspire.com/bmwofowingsmills/uploads/2024/07/P90548593_highRes_the-all-new-bmw-m4-c-1.jpg'],
            ['brand' => 'BMW', 'category' => 'SUV', 'model' => 'X5', 'year' => 2024, 'price' => 120.00, 'transmission' => 'automatic', 'fuel_type' => 'diesel', 'seats' => 5, 'image' => 'https://hips.hearstapps.com/hmg-prod/images/2024-bmw-x5-m60i-134-6602d491051b2.jpg?crop=0.686xw:0.514xh;0.152xw,0.341xh&resize=1200:*'],
            ['brand' => 'Mercedes-Benz', 'category' => 'Sedan', 'model' => 'C-Class', 'year' => 2024, 'price' => 110.00, 'transmission' => 'automatic', 'fuel_type' => 'gasoline', 'seats' => 5, 'image' => 'https://www.topgear.com/sites/default/files/2021/11/Mercedes_C300D_0000.jpg'],
            ['brand' => 'Mercedes-Benz', 'category' => 'SUV', 'model' => 'GLE', 'year' => 2024, 'price' => 130.00, 'transmission' => 'automatic', 'fuel_type' => 'diesel', 'seats' => 5, 'image' => 'https://www.cochesyconcesionarios.com/media/cache/1024w/uploads/mercedes/gle/2/od/mercedes-benz-gle-03-459db9c5962bb1d20d728b1e2efe7208ae2e68e0.jpeg'],
            ['brand' => 'Audi', 'category' => 'Sedan', 'model' => 'A4', 'year' => 2023, 'price' => 95.00, 'transmission' => 'automatic', 'fuel_type' => 'gasoline', 'seats' => 5, 'image' => 'https://www.diariomotor.com/imagenes/2019/05/audi-a4-limousine-lateral-vista-650576.jpg?class=XL'],
            ['brand' => 'Audi', 'category' => 'SUV', 'model' => 'Q5', 'year' => 2024, 'price' => 115.00, 'transmission' => 'automatic', 'fuel_type' => 'gasoline', 'seats' => 5, 'image' => 'https://www.topgear.com/sites/default/files/2025/04/Original-40038-audi-q5deansmith-015.jpg'],
            ['brand' => 'Nissan', 'category' => 'Sedan', 'model' => 'Altima', 'year' => 2023, 'price' => 48.00, 'transmission' => 'automatic', 'fuel_type' => 'gasoline', 'seats' => 5, 'image' => 'https://es.digitaltrends.com/tachyon/sites/13/2019/11/2020-altima-3.jpg?fit=1200%2C800'],
            ['brand' => 'Nissan', 'category' => 'SUV', 'model' => 'Pathfinder', 'year' => 2024, 'price' => 78.00, 'transmission' => 'automatic', 'fuel_type' => 'gasoline', 'seats' => 7, 'image' => 'https://hips.hearstapps.com/hmg-prod/images/2026-nissan-pathfinder-101-691367ad8429e.jpg?crop=0.693xw:0.519xh;0.138xw,0.301xh&resize=1200:*'],
            ['brand' => 'Hyundai', 'category' => 'Hatchback', 'model' => 'Elantra', 'year' => 2024, 'price' => 38.00, 'transmission' => 'manual', 'fuel_type' => 'gasoline', 'seats' => 5, 'image' => 'https://upload.wikimedia.org/wikipedia/commons/a/ac/0_Hyundai_Avante_%28CN7%29_FL_2.jpg'],
            ['brand' => 'Hyundai', 'category' => 'SUV', 'model' => 'Tucson', 'year' => 2024, 'price' => 65.00, 'transmission' => 'automatic', 'fuel_type' => 'gasoline', 'seats' => 5, 'image' => 'https://resizer.glanacion.com/resizer/v2/estetica-renovada-para-el-hyundai-ATKVTO5DGFGWZDZXO4SVXRIAZ4.jpg?auth=31180c2fc0e45d136cadc8707f7d3008cf180a2c1a78585bea112db33b77bcb1&width=1280&height=854&quality=70&smart=true'],
            ['brand' => 'Kia', 'category' => 'Sedan', 'model' => 'K5', 'year' => 2024, 'price' => 42.00, 'transmission' => 'automatic', 'fuel_type' => 'gasoline', 'seats' => 5, 'image' => 'https://hips.hearstapps.com/hmg-prod/images/2025-k5-03-65c4e39963e2d.jpg?crop=0.617xw:0.462xh;0.235xw,0.363xh&resize=1200:*'],
            ['brand' => 'Kia', 'category' => 'Van', 'model' => 'Carnival', 'year' => 2024, 'price' => 72.00, 'transmission' => 'automatic', 'fuel_type' => 'gasoline', 'seats' => 8, 'image' => 'https://autotest.com.ar/wp-content/uploads/2023/10/Kia-Carnival-2024-frente.jpg'],
            ['brand' => 'Mitsubishi', 'category' => 'SUV', 'model' => 'Outlander', 'year' => 2023, 'price' => 55.00, 'transmission' => 'automatic', 'fuel_type' => 'hybrid', 'seats' => 5, 'image' => 'https://autotest.com.ar/wp-content/uploads/2024/12/Mitushibi-Outlander-2025.jpg'],
            ['brand' => 'Chevrolet', 'category' => 'Pick-Up', 'model' => 'Silverado', 'year' => 2024, 'price' => 90.00, 'transmission' => 'automatic', 'fuel_type' => 'gasoline', 'seats' => 6, 'image' => 'https://cuyomotor.com.ar/wp-content/uploads/2021/09/chevrolet-silverado-2022-zr2-003.jpg'],
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
