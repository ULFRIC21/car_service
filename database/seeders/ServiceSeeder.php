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
                'price' => 3500,
                'duration_minutes' => 60,
            ],
            [
                'name' => 'Диагностика',
                'description' => 'Компьютерная диагностика',
                'price' => 2000,
                'duration_minutes' => 30,
            ],
            [
                'name' => 'Замена тормозных колодок',
                'description' => 'Передняя или задняя ось',
                'price' => 4500,
                'duration_minutes' => 90,
            ],
        ];

        foreach ($services as $service) {
            Service::firstOrCreate(
                ['name' => $service['name']],
                $service
            );
        }
    }
}
