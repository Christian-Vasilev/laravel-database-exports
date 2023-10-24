<?php

namespace App\Models;

use App\Enums\OrderStatusEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Return only records with status confirmed from relationship
     */
    public function ordersConfirmed(): HasMany
    {
        return $this->hasMany(Order::class)->whereStatus(OrderStatusEnum::CONFIRMED->value);
    }

    /**
     * Scope orders by given array of statuses
     */
    public function scopeOrderStatus(Builder $query, array $statuses): void
    {
        $query->whereHas(
            'orders',
            fn (Builder $subQuery): Builder => $subQuery->whereIn('status', $statuses)
        );
    }

    /**
     * Scope order product by given array of types
     */
    public function scopeProductType(Builder $query, array $types): void
    {
        $query->whereHas(
            'orders.product',
            fn (Builder $subQuery): Builder => $subQuery->whereIn('product_type', $types)
        );
    }
}
