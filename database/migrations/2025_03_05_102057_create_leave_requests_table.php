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
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->date('start_date'); // Start date of leave
            $table->date('end_date'); // End date of leave
            $table->integer('days_requested'); // Number of days requested
            $table->enum('status', ['pending', 'approved_by_manager', 'approved_by_hr', 'rejected'])->default('pending');
            $table->text('reason')->nullable(); // Reason for leave
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_requests');
    }
};
