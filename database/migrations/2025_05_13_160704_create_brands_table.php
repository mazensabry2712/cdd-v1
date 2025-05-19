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
        Schema::create('brands', function (Blueprint $table) {
          $table->id();
            $table->string('serial_number', 20)
                  ->unique()
                  ->comment('Format: PREFIX-XXX-XX, e.g., DELL-483-KQ');
            $table->enum('brand',['acer','apple','asus','dell','hp','lenovo','msi','samsung']);
            $table->string('model');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
