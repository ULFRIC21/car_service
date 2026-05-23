<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        $services = [
            [
                'name' => 'Замена масла',
                'description' => 'Масло и фильтр',
                'image_path' => 'Замена масла.jpg',
                'price' => 3500,
                'duration_minutes' => 60,
            ],
            [
                'name' => 'Диагностика',
                'description' => 'Компьютерная диагностика',
                'image_path' => 'Диагностика.png',
                'price' => 2000,
                'duration_minutes' => 30,
            ],
            [
                'name' => 'Замена тормозных колодок',
                'description' => 'Передняя или задняя ось',
                'image_path' => 'Замена тормозных колодок.png',
                'price' => 4500,
                'duration_minutes' => 90,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(
                ['name' => $service['name']],
                $service
            );
        }
    }
}
