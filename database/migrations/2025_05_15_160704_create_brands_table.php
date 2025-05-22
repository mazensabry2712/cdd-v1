<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('serial_number', 20)
                  ->unique()
                  ->comment('Format: PREFIX-XXX-XX, e.g., DELL-483-KQ');

            $table->foreignId('devicebrand_id')
                  ->constrained('devicebrands')
                  ->onDelete('cascade');

            $table->string('model')->comment('Model identifier');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
