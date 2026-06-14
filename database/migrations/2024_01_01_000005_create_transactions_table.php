<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('student');
            $table->string('type');
            $table->decimal('amount', 12, 2);
            $table->string('method');
            $table->string('status')->default('Pending');
            $table->date('date')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('transactions'); }
};