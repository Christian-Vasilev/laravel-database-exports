<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        Order::factory()
            ->count(30000)
            ->make()
            ->chunk(1000)
            ->each(fn (Collection $subset): bool => Order::insert($subset->toArray()));
    }
}
