<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * untuk membuat table
     */
    public function up(): void
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('name_barang');
            $table->char('jumlah_barang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * untuk menghapus table atau rollback.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
