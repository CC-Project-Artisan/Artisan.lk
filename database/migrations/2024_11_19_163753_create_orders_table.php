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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); 
            $table->string('email'); 
            $table->string('first_name')->nullable(); 
            $table->string('last_name');
            $table->text('address'); 
            $table->string('city'); 
            $table->string('phone'); 
            $table->decimal('total', 10, 2); 
            $table->string('stripe_payment_id')->nullable(); 
            $table->string('status')->default('pending'); 
            $table->enum('order_status', ['pending', 'accepted', 'rejected', 'processing', 'shipped', 'delivered'])->default('pending');
            $table->timestamps(); // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
