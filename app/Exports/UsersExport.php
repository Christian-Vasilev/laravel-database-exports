<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection, WithHeadings, WithMapping
{
    public function __construct(
        private readonly array $orderStatus,
        private readonly array $productType
    ) {
    }

    /**
     * Map value for each row in the export
     */
    public function map($row): array
    {
        return [
            'id' => $row->id,
            'email' => $row->email,
            'phone' => $row->phone,
            'nickname' => $row->nickname,
            'name' => $row->name,
            'last_name' => $row->last_name,
            'country' => $row->country,
            'dob_day' => $row->dob_day,
            'dob_month' => $row->dob_month,
            'dob_year' => $row->dob_year,
            'player_role' => $row->player_role,
            'avatar' => $row->avatar,
            'avatar_type' => $row->avatar_type,
            'avatar_gender' => $row->avatar_gender,
            'newsletter_subscribed' => $row->newsletter_subscribed,
            'total' => $row->ordersConfirmed->sum('total_amount'),
            'created_at' => $row->created_at,
            'updated_at' => $row->updated_at,
        ];
    }

    /**
     * Add custom heading name for the first row
     *
     * @return string[]
     */
    public function headings(): array
    {
        return [
            'id',
            'email',
            'phone',
            'nickname',
            'name',
            'last_name',
            'country',
            'Day of birth',
            'Month of birth',
            'Year of birth',
            'Role',
            'avatar',
            'Avatar Type',
            'Avatar Gender',
            'Is subscribed to newsletter',
            'Total',
            'created_at',
            'updated_at',
        ];
    }

    /**
     * Generate export collection
     *
     * @return Collection
     */
    public function collection()
    {
        return User::selectRaw('users.*, SUM(orders.total_amount) as total')
            ->join(
                'orders',
                fn (JoinClause $join) => $join->on('orders.user_id', '=', 'users.id')
                    ->where('orders.status', '=', $this->orderStatus)
            )->join(
                'products',
                fn (JoinClause $join) => $join->on('orders.product_id', '=', 'products.id')
                    ->whereIn('products.product_type', $this->productType)
            )
            ->groupBy('users.id')
            ->get();

        // The Eloquent way, but also a more slow way.

        //        return User::with('orders', 'orders.product')
        //            ->orderStatus($this->orderStatus)
        //            ->productType($this->productType)
        //            ->groupBy('id')
        //            ->get();
    }
}
