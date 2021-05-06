<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentsFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments_files', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('assignments_id')->unsigned();
            $table->foreign('assignments_id')->references('id')->on('assignments');
            $table->bigInteger('files_id')->unsigned();
            $table->foreign('files_id')->references('id')->on('files');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assignments_files');
    }
}
