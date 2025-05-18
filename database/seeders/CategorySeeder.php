<?php

namespace Database\Seeders;

use App\Models\CategoryModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Electro',
                'description' => 'Equipos eléctricos como licuadoras, hornos, microondas y electrodomésticos de cocina esenciales.',
                'created_at'=>date('Y-m-d'),
                'updated_at'=>date('Y-m-d'),
            ],
            [
                'name' => 'Ventilación',
                'description' => 'Productos relacionados con el confort térmico, incluyendo ventiladores, extractores y purificadores de aire.',
                'created_at'=>date('Y-m-d'),
                'updated_at'=>date('Y-m-d'),
            ],
            [
                'name' => 'Hogar',
                'description' => 'Artículos prácticos para el hogar y cocina: utensilios, organizadores, vajilla, ollas, y más.',
                'created_at'=>date('Y-m-d'),
                'updated_at'=>date('Y-m-d'),
            ],
        ];        

        foreach ($categories as $category) {
            CategoryModel::create($category);
        }
    }
}
