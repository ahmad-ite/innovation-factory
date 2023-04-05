<?php

use App\Enums\User\UserPrefixnameEnum;
use App\Enums\User\UserTypeEnum;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->enum('prefixname', UserPrefixnameEnum::getValues())
                ->default(null);
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('lastname');
            $table->string('suffixname')->nullable();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->text('password');
            $table->text('photo')->nullable();
            $table->enum('type', UserTypeEnum::getValues())
            ->default(UserTypeEnum::USER->value);
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('email');
            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};