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
        // Drop the table if it exists
        Schema::dropIfExists('vendor_exhibition_registrations');

        Schema::create('vendor_exhibition_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stall_id')->constrained('exhibition_stalls')->onDelete('cascade');
            $table->string('stall_type');
            $table->string('exhibitor_name');
            $table->string('exhibitor_email');
            $table->string('exhibitor_phone');
            $table->string('exhibition_address');
            $table->string('business_name');
            $table->string('business_category');
            $table->string('business_email');
            $table->string('business_phone');
            $table->text('requirements')->nullable();
            $table->decimal('total_price', 8, 2);
            $table->string('payment_status')->default('incomplete');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_exhibition_registrations');
    }
};
