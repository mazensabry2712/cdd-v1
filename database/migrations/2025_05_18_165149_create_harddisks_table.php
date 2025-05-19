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
        Schema::create('harddisks', function (Blueprint $table) {
            $table->id();
            $table->string('model', 100);
            $table->enum('health', ['Good', 'Warning', 'Critical']);
            $table->enum('interface', ['SATA', 'NVMe', 'SAS', 'PCIe'])??null;
            $table->unsignedInteger('capacity_gb');
            $table->enum('capacity_unit', ['GB', 'TB']);
            $table->string('serial_number')->unique();
            $table->string('pdf')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('harddisks');
    }
};
