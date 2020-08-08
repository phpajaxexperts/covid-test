<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCustomfieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customfields', function (Blueprint $table) {
            $table->increments('ID');
            $table->integer('type')->unsigned();
            $table->string('name')->nullable();
            $table->string('active');
            $table->foreign('type')->references('ID')->on('core_custom_field_type')->onDelete('cascade')->onUpdate('cascade');
            
            $table->timestamps();            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('customfields');
    }
}
