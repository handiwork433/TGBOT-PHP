<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('plan_id')->constrained();
            $table->decimal('amount', 10, 2);
            $table->string('currency');
            $table->enum('status', ['pending', 'paid', 'expired', 'failed']);
            $table->string('provider');
            $table->string('invoice_id')->unique();
            $table->string('tx_hash')->nullable();
            $table->string('payload_sig');
            $table->timestamps();
            $table->timestamp('paid_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
