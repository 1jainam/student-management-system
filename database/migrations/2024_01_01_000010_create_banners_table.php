<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('placement');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('status')->default('Draft');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('banners'); }
};