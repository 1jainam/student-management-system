<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('rpl_cases', function (Blueprint $table) {
            $table->id();
            $table->string('student');
            $table->string('course');
            $table->integer('credits_applied');
            $table->integer('credits_approved')->nullable();
            $table->string('status')->default('Under Review');
            $table->date('date')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('rpl_cases'); }
};