<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_settings', function (Blueprint $table) {
          $table->increments('id')->unique()->index();
          $table->string('name', 512);
          $table->longText('description');
          $table->boolean('with_ads')->default(false);
          $table->integer('player_width')->unsigned()->index();
          $table->integer('player_heigh')->unsigned()->index();
          $table->boolean('constrain_proportions')->default(false);
          $table->boolean('with_logo')->default(false);
          $table->boolean('autoplay')->default(false);
          $table->boolean('bootstrap')->default(false);
          $table->boolean('sharing')->default(false);
          $table->boolean('playlist')->default(false);
          $table->integer('logo_opacity')->default(10);
          $table->integer('video_id')->nullable();
          $table->string('logo_file_name')->nullable();
          $table->string('logo_href')->nullable();
          $table->timestamps();
          $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('player_settings');
    }
}
