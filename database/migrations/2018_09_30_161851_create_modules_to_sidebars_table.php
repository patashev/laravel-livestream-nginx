<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulesToSidebarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('modules_to_sidebars', function (Blueprint $table) {
             $table->increments('id');
             $table->string('name');
             $table->text('content');
             $table->integer('sidebar_types_id')->default(0);
             $table->integer('parent_id')->unsigned()->default(0);
             $table->boolean('is_hidden')->default(0);
             $table->integer('url_parent_id')->unsigned()->default(0);
             $table->integer('sidebars_id');
             $table->integer('cities_id')->unsigned()->default(0);
             $table->integer('module_id')->unsigned()->default(0);
             $table->integer('created_by')->unsigned();
             $table->integer('updated_by')->unsigned()->nullable();
             $table->integer('deleted_by')->unsigned()->nullable();
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
        Schema::dropIfExists('modules_to_sidebars');
    }
}
