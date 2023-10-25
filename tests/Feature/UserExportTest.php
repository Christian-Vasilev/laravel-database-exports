<?php

namespace Tests\Feature;

use App\Enums\OrderStatusEnum;
use App\Enums\ProductTypeEnum;
use App\Exports\UsersExport;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;

class UserExportTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();
        Order::factory()->state([
            'product_id' => Product::factory()->state(['price' => 500])->create()->id,
            'user_id' => $user->id,
            'status' => OrderStatusEnum::CONFIRMED->value,
            'total_amount' => 500,
        ])->count(2)->create();
    }

    /**
     * A basic feature test example.
     */
    public function test_export_returns_the_total_sum_for_given_user(): void
    {
        Excel::fake();

        $this->login();

        $this->post(route('exports.users'), [
            'type' => ProductTypeEnum::ALL->value,
        ]);

        Excel::assertDownloaded(
            'export.xlsx',
            fn (UsersExport $export): bool => $export->collection()->contains('total', '=', 1000)
        );
    }
}
