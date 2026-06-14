<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('student');
            $table->string('category');
            $table->string('priority')->default('Medium');
            $table->string('status')->default('Open');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('tickets'); }
};