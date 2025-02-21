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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')->constrained()->onDelete('cascade'); // Foreign key ke tabel packages
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->date('selected_date');
            $table->string('pax_category'); // Menyimpan kategori pax seperti '10-14'
            $table->integer('num_pax'); // Jumlah pax yang dipesan
            $table->decimal('total_price', 15, 2); // Total harga pemesanan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
