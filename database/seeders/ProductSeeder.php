<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory()
            ->count(20000)
            ->make()
            ->chunk(1000)
            ->each(fn (Collection $subset): bool => Product::insert($subset->toArray()));
    }
}
