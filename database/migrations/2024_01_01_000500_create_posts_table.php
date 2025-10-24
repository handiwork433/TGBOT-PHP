<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('signal_id')->constrained();
            $table->string('channel');
            $table->timestamp('sent_at');
            $table->integer('delivered_count')->default(0);
            $table->integer('read_count')->default(0);
            $table->decimal('ctr', 5, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
