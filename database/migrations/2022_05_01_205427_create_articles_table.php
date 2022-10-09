<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title', 80);
            $table->text('body');
            $table->string('postExcerpt');
            $table->string('slug')->unique()->default('');
            $table->string('featuredImage')->nullable();
            $table->text('header_image_public_id')->nullable();
            $table->string('metaDescription', 300);
            $table->uuid('health_professional_id');
            $table->foreign('health_professional_id')->references('id')->on('health_professionals');
            $table->uuid('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->timestamp('published_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
};