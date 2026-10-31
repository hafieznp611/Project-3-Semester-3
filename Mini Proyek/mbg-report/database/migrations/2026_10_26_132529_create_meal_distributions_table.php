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
            $table->foreignId('sppg_id')->constrained('sppgs')->cascadeOnDelete();
            $table->foreignId('school_id')->constrained('schools')->cascadeOnDelete();

            $table->date('tanggal_distribusi');
            $table->string('menu');
            $table->unsignedInteger('jumlah_porsi');
            $table->enum('status', ['dijadwalkan', 'dikirim', 'diterima', 'bermasalah'])
                ->default('dijadwalkan');
            $table->text('catatan')->nullable();
            $table->timestamps();

            // satu sekolah hanya punya satu distribusi per hari
            $table->unique(['school_id', 'tanggal_distribusi']);
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
