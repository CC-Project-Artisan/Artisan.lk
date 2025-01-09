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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // For guest users
            $table->string('email');
            $table->string('country');
            $table->string('first_name')->nullable();
            $table->string('last_name');
            $table->text('address');
            $table->string('apartment')->nullable();
            $table->string('city');
            $table->string('postal_code')->nullable();
            $table->string('phone');
            $table->timestamps();

            // Foreign key for authenticated users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

            $table->index('user_id');
            $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
