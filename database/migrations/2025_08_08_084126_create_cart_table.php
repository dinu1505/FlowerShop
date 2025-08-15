<?php

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
        Schema::create('cart', function (Blueprint $table) {
        $table->id();
        $table->string('item_type'); // 'flower' or 'arrangement'
        $table->unsignedBigInteger('item_id'); // flower.id or arrangement.id
        $table->string('name');
        $table->integer('qty');
        $table->decimal('price', 8, 2);
        $table->string('image')->nullable();
        $table->timestamps();
    });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart');
    }
};
