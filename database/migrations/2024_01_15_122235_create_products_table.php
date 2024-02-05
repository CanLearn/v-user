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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('title_en');
            $table->string('slug')->unique();
            $table->string('slug_en')->unique();
            $table->longText('summary')->nullable();
            $table->longText('summary_en')->nullable();
            $table->longText('content')->nullable();
            $table->longText('content_en')->nullable();
            $table->longText('multi_image')->nullable();
            $table->longText('multi_image_en')->nullable();
            $table->longText('video_url')->nullable();
            $table->longText('video_url_en')->nullable();
            $table->unsignedBigInteger('price')->nullable();
            $table->unsignedBigInteger('price_en')->nullable();
            $table->enum('status_price', \App\Models\Panel\Product::$status_price);
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
