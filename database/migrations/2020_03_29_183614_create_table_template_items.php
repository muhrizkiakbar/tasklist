<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTemplateItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('template_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->integer('urgency');
            $table->integer('due_interval');
            $table->string('due_unit');
            $table->timestamps();
        });


        Schema::table('template_items', function (Blueprint $table) {
            $table->integer('template_id')->unsigned();
        
            $table->foreign('template_id')->references('id')->on('templates')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('template_items', function (Blueprint $table) {
            $table->dropForeign(['template_id']);
        });
        Schema::drop('template_items');
    }
}
