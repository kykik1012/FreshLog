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
        Schema::create('detail_penyimpanans', function (Blueprint $table) {
            $table->id(); // ID_detail
            $table->date('tanggal_simpan');
            $table->date('tanggal_kadaluarsa');
            $table->string('status')->default('Layak Makan');
            $table->integer('kuantitas')->default(0);
            $table->foreignId('item_id')->constrained('items')->cascadeOnDelete();
            $table->foreignId('lokasi_id')->constrained('lokasis')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_penyimpanans');
    }
};
