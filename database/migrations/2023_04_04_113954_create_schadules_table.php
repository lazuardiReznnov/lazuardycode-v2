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
        Schema::create('schadules', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('debt_id')
                ->constrained('debts')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->date('tgl');
            $table->integer('amount');
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schadules');
    }
};
