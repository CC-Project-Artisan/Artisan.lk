<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Drop tables in correct order
        Schema::dropIfExists('exhibition_contacts');
        Schema::dropIfExists('exhibition_emails');
        Schema::dropIfExists('exhibition_stalls');
        Schema::dropIfExists('vendor_exhibition_registrations');
        Schema::dropIfExists('exhibitions');

        Schema::create('exhibitions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('exhibition_name');
            $table->text('exhibition_description');
            $table->date('exhibition_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('exhibition_location');
            $table->string('organization_name');
            $table->json('exhibitionBanner');
            $table->string('category_name');
            $table->date('registration_start_date')->nullable();
            $table->date('registration_end_date')->nullable();
            $table->integer('max_exhibitors')->nullable();
            $table->integer('vendor_entrance_fee')->nullable();
            $table->integer('regular_price')->nullable();
            $table->integer('student_price')->nullable();
            $table->integer('child_price')->nullable();
            $table->json('social_media_links')->nullable();
            $table->string('layout')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'paid'])->default('pending');
            $table->timestamp('status_updated_at')->nullable();
            $table->boolean('isActive')->default(true);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exhibition_contacts');
        Schema::dropIfExists('exhibition_emails');
        Schema::dropIfExists('exhibition_stalls');
        Schema::dropIfExists('vendor_exhibition_registrations');
        Schema::dropIfExists('exhibitions');
    }
};