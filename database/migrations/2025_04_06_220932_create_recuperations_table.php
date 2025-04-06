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
        Schema::create('recuperations', function (Blueprint $table) {
            $table->id();
             $table->foreignId('command_id')->constrained()->onDelete('cascade');
    $table->boolean('recuperee')->default(false);
    $table->timestamp('recuperee_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recuperations');
    }
};
