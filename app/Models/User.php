<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class User extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'phone',
        'nickname',
        'name',
        'last_name',
        'country',
        'dob_day',
        'dob_month',
        'dob_year',
        'player_role',
        'avatar',
        'avatar_type',
        'avatar_gender',
        'newsletter_subscribed',
    ];

    /**
     * User -> Products relationship
     *
     * @return HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
    public function ordersConfirmed(): HasMany
    {
        return $this->hasMany(Order::class)->whereStatus('confirmed');
    }

    public function scopeOrderStatus(Builder $query, array $statuses): void
    {
        $query->whereHas(
            'orders',
            fn (Builder $subQuery): Builder => $subQuery->whereIn('status', $statuses)
        );
    }

    public function scopeProductType(Builder $query, array $types): void
    {
        $query->whereHas(
            'orders.product',
            fn (Builder $subQuery): Builder => $subQuery->whereIn('product_type', $types)
        );
    }

    public function scopeWithTotalSum(Builder $query): void
    {
        $query->whereHas(
            'orders',
            fn (Builder $subQuery): Builder => $subQuery->addSelect(DB::raw('sum(total_amount) as `total`'))->groupBy('user_id')
        );
    }
}
