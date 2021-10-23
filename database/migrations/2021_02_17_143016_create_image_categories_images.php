<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageCategoriesImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_categories_images', function (Blueprint $table) {
            $table->integer('category_id');
            $table->foreign('category_id')
                  ->references('id')
                  ->on('image_categories')->onDelete('cascade');        
            $table->integer('image_id');
            $table->foreign('image_id')
                  ->references('id')
                  ->on('images')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('image_categories_images');
    }
}
