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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('user_name');
            $table->integer('number');
            $table->string('date_of_birth');
            $table->integer('address');
            $table->string('street');
            $table->string('country');
            $table->string('county');
            $table->string('city');
            $table->integer('pin_code');
            $table->string('name');
            $table->string('email')->unique();
            $table->tinyInteger('type');
            $table->string('national_id_front');
            $table->string('national_id_back');
            $table->string('proof_front');
            $table->string('proof_back');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
