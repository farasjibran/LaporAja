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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->foreignId('goverment_id')->constrained('goverments')->onDelete('cascade');
            $table->string('unique_code')->nullable();
            $table->string('complaint_type');
            $table->text('description');
            $table->enum('status', ['open', 'closed', 'in_progress'])->default('open');
            $table->string('attachment')->nullable();
            $table->unique('unique_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
