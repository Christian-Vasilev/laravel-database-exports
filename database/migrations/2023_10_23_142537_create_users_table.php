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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('nickname');
            $table->string('name');
            $table->string('last_name');
            $table->string('country');
            $table->tinyInteger('dob_day')->unsigned();
            $table->tinyInteger('dob_month')->unsigned();
            $table->smallInteger('dob_year')->unsigned();
            $table->enum('player_role', [1, 2, 3]);
            $table->string('avatar');
            $table->enum('avatar_type', ['raceAvatar', 'uploadedCharacter']);
            $table->enum('avatar_gender', ['Male', 'Female']);
            $table->tinyInteger('newsletter_subscribed')->unsigned();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
