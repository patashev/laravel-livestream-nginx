<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id')->unique()->index();
            $table->integer('date_n')->unsigned()->nullable();
            $table->text('title')->nullable();
            $table->text('comment')->nullable();
            $table->text('title_e')->nullable();
            $table->text('comment_e')->nullable();
            $table->text('keywords')->nullable();
            $table->string('preview', 255);
            $table->string('image', 255);
            $table->integer('linked')->nullable();
            $table->integer('volume')->nullable();
            $table->integer('pic_date')->nullable();
            $table->integer('hdd')->nullable();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
}
