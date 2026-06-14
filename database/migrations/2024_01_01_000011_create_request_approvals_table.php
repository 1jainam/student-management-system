<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('request_approvals', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('requester');
            $table->string('department');
            $table->text('details');
            $table->string('status')->default('Pending');
            $table->date('date')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('request_approvals'); }
};