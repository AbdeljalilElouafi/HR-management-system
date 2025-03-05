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
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Training title
            $table->text('description')->nullable(); // Training description
            $table->date('start_date'); // Training start date
            $table->date('end_date'); // Training end date
            $table->foreignId('department_id')->nullable()->constrained()->onDelete('set null'); // Associated department
            $table->foreignId('company_id')->constrained()->onDelete('cascade'); // Associated company
            $table->timestamps();
            $table->softDeletes(); // Enable soft delete
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainings');
    }
};
