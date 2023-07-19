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
        Schema::create('posteds', function (Blueprint $table) {
           
            $table->string('product_id')->primary();
            $table->string('product_name');
            $table->longText('description');
            $table->string('reserve_price');
            $table->string('image');
            $table->string('available_units');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->string('seller_email');
            $table->string('status')->default('not_in_progress')->change();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posteds');
    }
};
