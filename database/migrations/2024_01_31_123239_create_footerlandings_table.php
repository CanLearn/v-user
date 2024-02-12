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
        Schema::create('footerlandings', function (Blueprint $table) {
            $table->id();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('number_whatsapp');
            $table->string('telegram')->nullable();
            $table->string('yahoo')->nullable();
            $table->string('gmail')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('address_en')->nullable();
            $table->string('phone_en')->nullable();
            $table->string('number_whatsapp_en');
            $table->string('telegram_en')->nullable();
            $table->string('yahoo_en')->nullable();
            $table->string('gmail_en')->nullable();
            $table->string('whatsapp_en')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('footerlandings');
    }
};
