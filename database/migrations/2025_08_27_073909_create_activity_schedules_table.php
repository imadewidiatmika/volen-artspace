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
        Schema::create('activity_schedules', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('time');
            $table->string('activity');
            $table->string('location');
            $table->decimal('price', 15, 2);
            $table->integer('registered_participants')->default(0);
            $table->integer('attended_participants')->default(0);
            $table->enum('status', ['Open Registration', 'Closed Registration', 'Completed', 'Cancelled'])->default('Open Registration');
            $table->integer('max_participants')->default(20); // Batas maksimal peserta
            $table->text('description')->nullable();
            $table->timestamps();
            
            // Indexes
            $table->index(['date', 'time']);
            $table->index('status');
            $table->index('activity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_schedules');
    }
};
