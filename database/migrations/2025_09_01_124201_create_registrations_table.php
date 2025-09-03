<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_registrations_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();

            $table->foreignUuid('participant_id')->constrained('participants')->onDelete('cascade');
            $table->foreignId('activity_schedule_id')->constrained('activity_schedules')->onDelete('cascade');

            $table->string('prtcp_remark');
            $table->string('status')->default('LISTED');
            $table->string('receipt_path')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};