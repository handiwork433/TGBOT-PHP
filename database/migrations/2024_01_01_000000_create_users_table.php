<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tg_user_id')->nullable()->unique();
            $table->string('tg_username')->nullable();
            $table->string('locale')->default('ru');
            $table->string('timezone')->default('Europe/Prague');
            $table->string('ref_code')->unique();
            $table->foreignId('referred_by')->nullable()->constrained('users');
            $table->boolean('is_banned')->default(false);
            $table->boolean('is_admin')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
