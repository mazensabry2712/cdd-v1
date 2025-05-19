 <?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('devicebrands', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Brand name');
            $table->string('image')->comment('Path or filename of the brand image');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('devicebrands');
    }
};
