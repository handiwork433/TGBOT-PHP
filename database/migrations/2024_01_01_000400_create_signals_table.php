<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('signals', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('content_md');
            $table->json('tags')->nullable();
            $table->enum('risk_level', ['low', 'medium', 'high']);
            $table->decimal('expected_margin_pct', 5, 2)->nullable();
            $table->json('legs_json')->nullable();
            $table->json('attachments')->nullable();
            $table->enum('lang', ['ru', 'en'])->default('ru');
            $table->json('audience_filters')->nullable();
            $table->timestamp('publish_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('signals');
    }
};
