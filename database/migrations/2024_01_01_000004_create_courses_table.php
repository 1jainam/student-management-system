<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->string('duration');
            $table->integer('seats')->default(60);
            $table->integer('enrolled')->default(0);
            $table->string('faculty');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('courses'); }
};