<?php

namespace Database\Seeders;

use App\Models\Part;
use App\Models\Promotion;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@autoservice.local'],
            [
                'name' => 'Администратор',
                'password' => Hash::make('password'),
            ]
        );
        $admin->forceFill(['is_admin' => true])->save();

        $services = [
            ['name' => 'Диагностика ходовой', 'description' => 'Компьютерная и визуальная диагностика', 'price' => 1500, 'duration_minutes' => 60],
            ['name' => 'Замена масла ДВС', 'description' => 'Масло и фильтр (без расходников)', 'price' => 800, 'duration_minutes' => 30],
            ['name' => 'Развал-схождение', 'description' => 'На стенде', 'price' => 2200, 'duration_minutes' => 90],
            ['name' => 'ТО по регламенту', 'description' => 'По пробегу производителя', 'price' => 4500, 'duration_minutes' => 180],
            ['name' => 'Замена тормозных колодок (перед)', 'description' => 'Пара', 'price' => 1900, 'duration_minutes' => 60],
        ];

        foreach ($services as $row) {
            Service::firstOrCreate(
                ['name' => $row['name']],
                array_merge($row, ['is_active' => true])
            );
        }

        $parts = [
            ['sku' => 'OIL-5W40-4L', 'name' => 'Масло моторное 5W-40 4л', 'stock_qty' => 40, 'unit_price' => 3200],
            ['sku' => 'FIL-OIL-01', 'name' => 'Фильтр масляный универсальный', 'stock_qty' => 120, 'unit_price' => 450],
            ['sku' => 'PAD-F-STD', 'name' => 'Колодки тормозные передние', 'stock_qty' => 25, 'unit_price' => 2800],
        ];

        foreach ($parts as $row) {
            Part::firstOrCreate(
                ['sku' => $row['sku']],
                $row
            );
        }

        Promotion::firstOrCreate(
            ['title' => 'Скидка 10% на ТО в будни'],
            [
                'body' => 'Действует по будням при записи онлайн.',
                'is_active' => true,
                'starts_at' => now()->subWeek(),
                'ends_at' => now()->addMonths(2),
            ]
        );
    }
}
