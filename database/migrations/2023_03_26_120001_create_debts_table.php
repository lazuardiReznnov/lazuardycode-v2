<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('debts', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('acount_fintech_id')
                ->constrained('acount_finteches')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table
                ->foreignId('transaction_id')
                ->constrained('transactions')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->integer('amount');
            $table->integer('tenor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('debts');
    }
};
