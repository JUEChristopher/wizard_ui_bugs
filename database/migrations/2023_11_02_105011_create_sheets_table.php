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
        Schema::create('sheets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('code')->unique();
            $table->string('trainer');
            $table->integer('module');
            $table->string('course_url')->nullable();
            $table->string('course');
            $table->string('option');
            $table->string('team');
            $table->json('duration');
            $table->json('objectives');
            $table->json('prerequisites');
            $table->json('conditions');
            $table->json('schedule');
            $table->json('internal_competencies')->nullable();
            $table->string('certification_number')->nullable();
            $table->string('path')->unique()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sheets');
    }
};
