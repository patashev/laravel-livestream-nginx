<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSidebarWeatherTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sidebar_weather_types', function (Blueprint $table) {
          $table->increments('id')->unique()->index();
          $table->string('name');
          $table->string('icon_name');
          $table->timestamps();
          $table->softDeletes();
          $table->integer('created_by')->unsigned();
          $table->integer('updated_by')->unsigned()->nullable();
          $table->integer('deleted_by')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sidebar_weather_types');
    }
}
