<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('incident_reports', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('school_id')->constrained('schools')->cascadeOnDelete();
            $table->foreignId('meal_distribution_id')->nullable()
                  ->constrained('meal_distributions')->nullOnDelete();

            $table->string('judul');
            $table->text('deskripsi');
            $table->date('tanggal_kejadian');
            $table->string('foto')->nullable();

            $table->enum('status', ['menunggu', 'diproses', 'selesai', 'ditolak'])
                  ->default('menunggu');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('incident_reports');
    }
};