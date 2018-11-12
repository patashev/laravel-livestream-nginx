<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIp2locationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ip2locations', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('ip_from');
            $table->bigInteger('ip_to');
            $table->string('country_code', 2);
            $table->string('country_name', 64);
            $table->string('region_name', 128);
            $table->string('city_name', 128);
            $table->double('latitude');
            $table->double('longitude');
            $table->string('zip_code', 30);
            $table->string('time_zone', 30);
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
        Schema::dropIfExists('ip2locations');
    }
}
