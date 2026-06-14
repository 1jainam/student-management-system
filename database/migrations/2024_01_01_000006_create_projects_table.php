<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('department');
            $table->string('lead');
            $table->date('deadline');
            $table->integer('progress')->default(0);
            $table->string('status')->default('Planning');
            $table->integer('members')->default(1);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('projects'); }
};