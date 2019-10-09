<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLettersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('letters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('type'); 
            $table->string("from");
            $table->string("about");
            $table->string("description");
            $table->date("sent_at");
            $table->dateTime("received_at");
            $table->integer("organization_id");
            $table->string("shelf")->nullable(); 
            $table->string("row")->nullable(); 
            $table->string("folder")->nullable(); 
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
        Schema::dropIfExists('letters');
    }
}
