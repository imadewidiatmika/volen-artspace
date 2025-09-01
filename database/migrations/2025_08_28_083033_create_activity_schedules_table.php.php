<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_activity_schedules_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::create('activity_schedules', function (Blueprint $table) {
        $table->id();
        $table->date('date');
        $table->time('time');

        // INI BAGIAN YANG DIPERBAIKI
        // 1. Buat kolom dengan tipe data UUID
        $table->uuid('activity_id');
        // 2. Hubungkan sebagai foreign key ke tabel activities
        $table->foreign('activity_id')->references('id')->on('activities')->onDelete('cascade');

        $table->string('location');
        $table->decimal('price', 15, 2);
        $table->integer('max_participants')->default(20);
        $table->integer('registered_participants')->default(0);
        $table->integer('attended_participants')->default(0);
        $table->enum('status', ['Open Registration', 'Closed Registration', 'Completed', 'Cancelled'])->default('Open Registration');
        $table->text('description')->nullable();
        $table->timestamps();

        // Indexes
        $table->index(['date', 'time']);
        $table->index('status');
    });
}

    public function down(): void
    {
        Schema::dropIfExists('activity_schedules');
    }
};