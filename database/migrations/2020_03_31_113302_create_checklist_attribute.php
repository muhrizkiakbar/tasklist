<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChecklistAttribute extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('checklist_attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('object_domain');
            $table->string('description');
            $table->boolean('is_completed');
            $table->dateTime('completed_at')->nullable();
            $table->string('due_unit')->nullable;
            $table->integer('urgency');
            $table->timestamps();
        });


        Schema::table('checklist_attributes', function (Blueprint $table) {
            $table->integer('checklist_id')->unsigned();
        
            $table->foreign('checklist_id')->references('id')->on('checklists')->onDelete('cascade');
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

        Schema::table('checklist_attributes', function (Blueprint $table) {
            $table->dropForeign(['checklist_id']);
        });
        Schema::drop('checklist_attributes');
    }
}
