<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->dateTime('selected_at');
            $table->dateTime('completed_at');
            $table->bigInteger('teachers_id')->unsigned();
            $table->foreign('teachers_id')->references('id')->on('teachers');
            $table->bigInteger('students_id')->unsigned();
            $table->foreign('students_id')->references('id')->on('students');
            $table->bigInteger('questions_id')->unsigned();
            $table->foreign('questions_id')->references('id')->on('questions');
            $table->bigInteger('choice_id')->unsigned();
            $table->foreign('choice_id')->references('id')->on('choices');
            $table->text('notes');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assignments');
    }
}
