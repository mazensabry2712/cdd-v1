<?php

// namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// use Illuminate\Database\Seeder;

// use App\Models\Brands;
// use Illuminate\Support\Str;

// class BrandsSeeder extends Seeder
// {
//     /**
//      * Run the database seeds.
//      */
//     public function run(): void
//     {
//           $brands = [
//             ['brand' => 'Dell',   'model' => 'Inspiron 15'],
//              ['brand' => 'Dell',   'model' => 'XPS 13'],
//             ['brand' => 'HP',     'model' => 'Pavilion x360'],
//              ['brand' => 'HP',     'model' => 'Envy 13'],
//             ['brand' => 'Lenovo', 'model' => 'ThinkPad X1 Carbon'],
//             ['brand' => 'Lenovo', 'model' => 'IdeaPad 5'],
//             ['brand' => 'Apple',  'model' => 'MacBook Pro 16'],
//             ['brand' => 'Asus',   'model' => 'ROG Zephyrus G14'],
//             ['brand' => 'Acer',   'model' => 'Swift 3'],
//         ];

//         foreach ($brands as $item) {
//             Brands::create([
//                 'serial_number' => strtoupper(Str::random(10)),
//                 'brand' => $item['brand'],
//                 'model' => $item['model'],
//             ]);
//         }
//     }
// }
