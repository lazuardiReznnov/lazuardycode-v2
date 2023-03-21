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
        Schema::create('pricings', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->integer('cash')->default(0);
            $table->integer('dp')->default(0);
            $table->integer('three')->default(0);
            $table->integer('six')->default(0);
            $table->integer('nine')->default(0);
            $table->integer('twelve')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricings');
    }
};
