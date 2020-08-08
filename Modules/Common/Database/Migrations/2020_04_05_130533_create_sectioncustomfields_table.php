<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSectioncustomfieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sectioncustomfields', function (Blueprint $table) {
            $table->increments('ID');
            $table->integer('section_rs')->nullable();
            $table->integer('section')->nullable();
            $table->integer('custom_field')->unsigned();
            $table->foreign('custom_field')->references('ID')->on('core_custom_fields')->onDelete('cascade')->onUpdate('cascade');
            
            $table->timestamps();            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sectioncustomfields');
    }
}
