<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('serviceID')->constrained('services')->onDelete('cascade');
            $table->string('customerName');
            $table->string('contactNumber');
            $table->date('appointmentDate');
            $table->time('appointmentTime');
            $table->foreignId('userID')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            $table->string('status')->default('pending');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
