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
        Schema::table('activities', function (Blueprint $table) {
            $table->string('code')->unique()->after('category_id');
            $table->date('start_at');
            $table->date('end_at');
            $table->string('location')->nullable();
            $table->unsignedInteger('capacity');
            $table->string('poster_path')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activities', function (Blueprint $table) {
             $table->dropColumn(['code', 'start_at', 'end_at', 'location', 'capacity' , 'poster_path']);
        });
    }
};
