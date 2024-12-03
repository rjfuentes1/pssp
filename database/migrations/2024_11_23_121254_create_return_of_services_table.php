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
        Schema::create('return_of_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scholar_id');
            $table->string('agreement')->nullable();
            $table->string('board_take')->nullable();
            $table->string('board_status')->nullable();
            $table->date('start_of_deployment')->nullable();
            $table->date('end_of_deployment')->nullable();
            $table->string('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('return_of_services');
    }
};
