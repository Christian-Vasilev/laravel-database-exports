<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'product_description',
        'product_short',
        'price',
        'currency',
        'product_type',
        'product_image',
        'show_in_store',
        'position',
    ];
}
