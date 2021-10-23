<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_records', function (Blueprint $table) {
            $table->increments('id')->unique()->index();
            $table->string('name');
            $table->string('slug');
            $table->timestamps();
            $table->softDeletes();
            $table->string('entry_id', 52)->nullable();
            $table->integer('user_id')->nullable();
            $table->string('apy_key', 52)->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->integer('category_id');
            $table->string('vcodec_name', 15)->nullable();
            $table->string('vcodec_long_name', 50)->nullable();
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->string('ratio', 10)->nullable();
            $table->string('duraction', 86)->nullable();
            $table->integer('bit_rate')->nullable();
            $table->string('acodec_name', 15)->nullable();
            $table->string('acodec_long_name', 50)->nullable();
            $table->integer('sample_rate')->nullable();
            $table->integer('channels')->nullable();
            $table->string('format_name', 8)->nullable();
            $table->string('format_long_name', 56)->nullable();
            $table->string('file_name', 56)->nullable();
            $table->string('file_path', 156)->nullable();
            $table->string('thumb_path', 156)->nullable();
            $table->string('prefix', 56)->nullable();
            $table->integer('live_play_count')->nullable();
            $table->string('status', 56)->nullable();
            $table->timestamp('active_from')->nullable(); // aka posted_at (default now)
            $table->timestamp('active_to')->nullable();
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
        Schema::dropIfExists('video_records');
    }
}
