<?php

use App\Enums\Detail\DetailTypeEnum;
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
        Schema::create('details', function (Blueprint $table) {
            $table->id();

            $table->string('key');

            $table->text('value')->nullable();
            $table->string('icon')->nullable();
            $table->string('status');
            $table->enum('type', DetailTypeEnum::getValues())
                  ->default(DetailTypeEnum::DETAIL->value);
            $table->foreignId('user_id')->constrained('users')->nullable()->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('details');
    }
};
