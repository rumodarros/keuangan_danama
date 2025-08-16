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
        Schema::create('keuangan', function (Blueprint $table) {
            $table->id();
            $table->decimal('jumlah', 15, 2);
            $table->date('tanggal');
            $table->string('sumber')->nullable();   // contoh: "APBD", "Dana Desa", atau nama pihak
            $table->string('tujuan')->nullable();   // contoh: "Proyek Jalan", "Honor"
            $table->decimal('total', 15, 2)->nullable(); // bila ada ringkasan/rekap total
            $table->text('keterangan')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // pembuat / penanggung jawab
            $table->foreignId('dana_desa_id')->nullable()->constrained('dana_desa')->onDelete('set null'); // opsional
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keuangan');
    }
};
