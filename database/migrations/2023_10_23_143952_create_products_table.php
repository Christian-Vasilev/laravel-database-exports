<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('product_name');
            $table->text('product_description');
            $table->string('product_short_description');
            $table->integer('price')->unsigned();
            $table->string('currency');
            $table->enum('product_type', ['account', 'ingame_goods', 'physical_goods']);
            $table->string('product_image');
            $table->tinyInteger('show_in_store');
            $table->integer('position')->unsigned();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
