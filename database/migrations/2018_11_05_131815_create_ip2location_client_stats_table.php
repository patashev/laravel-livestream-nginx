<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIp2locationClientStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ip2location_client_stats', function (Blueprint $table) {
            $table->increments('id')->unique()->index();
            $table->string('stream_name');
            $table->string('title', 512);
            $table->bigInteger('ip_number');
            $table->bigInteger('ip_version');
            $table->string('ip_address', 24);
            $table->string('country_code', 5);
            $table->string('country_name', 64);
            $table->string('region_name', 128);
            $table->string('city_name', 128);
//            $table->integer('latitude')->nullable();
//            $table->integer('longitude')->nullable();
//            $table->string('zip_code', 30)->nullable();
//            $table->string('time_zone', 30)->nullable();
//            $table->string('user_agent', 512)->nullable();
            $table->timestamps();
            $table->date('date_action', 128)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ip2location_client_stats');
    }
}
