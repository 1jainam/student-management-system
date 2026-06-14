<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('re_evaluations', function (Blueprint $table) {
            $table->id();
            $table->string('student');
            $table->string('subject');
            $table->string('exam');
            $table->integer('current_marks');
            $table->integer('revised_marks')->nullable();
            $table->string('status')->default('Pending');
            $table->date('applied_on')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('re_evaluations'); }
};