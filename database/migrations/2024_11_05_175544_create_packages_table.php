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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('package_name');
            $table->string('banner')->nullable();
            $table->string('time');
            $table->string('route');
            $table->text('description')->nullable();
            $table->integer('min_price');
            $table->json('include')->nullable(); // Menggunakan JSON untuk include
            $table->json('exclude')->nullable(); // Menggunakan JSON untuk exclude
            $table->json('rundown')->nullable(); // Menggunakan JSON untuk rundown
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
