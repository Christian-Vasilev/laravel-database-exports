<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->count(150000)
            ->make()
            ->chunk(1000)
            ->each(fn (Collection $subset): bool => User::insert($subset->toArray()));
    }
}
