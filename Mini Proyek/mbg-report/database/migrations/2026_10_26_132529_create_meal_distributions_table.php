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
        Schema::create('meal_distributions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('school_id')->constrained('schools')->cascadeOnDelete();

            $table->string('nama_sppg');
            $table->string('penanggung_jawab')->nullable();
            $table->string('kontak_penanggung_jawab',20)->nullable();

            $table->date('tanggal_distribusi');
            $table->string('menu');
            $table->unsignedInteger('jumlah_porsi');

            $table->enum('status', ['Dijadwalkan' , 'Dikirim', 'Diterima', 'Bermasalah'])
                ->default('Dijadwalkan');
            $table->text('catatan')->nullable;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meal_distributions');
    }
};
