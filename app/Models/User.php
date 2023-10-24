<?php

namespace App\Models;

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
     *
     * @return HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
