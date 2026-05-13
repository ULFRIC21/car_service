<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AutoServiceSeeder extends Seeder
{
    public function run()
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@autoservice.ru'],
            [
                'name' => 'Администратор',
                'role' => 'admin',
                'password' => Hash::make('admin123'),
            ]
        );

        $services = [
            ['name' => 'Замена масла', 'description' => 'Замена моторного масла и масляного фильтра', 'price' => 2500, 'duration_minutes' => 30],
            ['name' => 'Диагностика двигателя', 'description' => 'Компьютерная диагностика всех систем двигателя', 'price' => 1500, 'duration_minutes' => 60],
            ['name' => 'Замена тормозных колодок', 'description' => 'Замена передних или задних тормозных колодок', 'price' => 3000, 'duration_minutes' => 90],
            ['name' => 'Шиномонтаж', 'description' => 'Снятие, монтаж и балансировка 4 колёс', 'price' => 2000, 'duration_minutes' => 45],
            ['name' => 'Замена ремня ГРМ', 'description' => 'Замена ремня газораспределительного механизма с роликами', 'price' => 8000, 'duration_minutes' => 180],
            ['name' => 'Развал-схождение', 'description' => 'Регулировка углов установки колёс на 3D стенде', 'price' => 2500, 'duration_minutes' => 60],
            ['name' => 'Замена антифриза', 'description' => 'Полная замена охлаждающей жидкости', 'price' => 1800, 'duration_minutes' => 30],
            ['name' => 'ТО (полное)', 'description' => 'Полное техническое обслуживание: масло, фильтры, свечи, проверка всех систем', 'price' => 7000, 'duration_minutes' => 120],
        ];

        foreach ($services as $service) {
            Service::firstOrCreate(['name' => $service['name']], $service);
        }
    }
}
