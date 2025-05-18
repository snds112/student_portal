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
        Schema::create('student_project_wishlist', function (Blueprint $table) {
            $table->id()->primary()->autoIncrement();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('project_id');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('project')->onDelete('cascade');
            $table->unique(['student_id', 'project_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_project_wishlist');
    }
};
