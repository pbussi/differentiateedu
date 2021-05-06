<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChoiceFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('choice_file', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('file_id')->unsigned();
            $table->text('description');
            $table->foreign('file_id')->references('id')->on('files');
            $table->bigInteger('choice_id')->unsigned();
            $table->foreign('choice_id')->references('id')->on('choices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('choice_file');
    }
}
