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
        Schema::create('orders', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('user_email');
            $table->string('productName');
            $table->longText('description');
            $table->string('units');
            $table->string('image');
            $table->string('amount');
            $table->string('sellerEmail');
            $table->string('name');
            $table->string('email');
            $table->string('number');
            $table->string('address');
            $table->string('county');
            $table->string('delivery');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
