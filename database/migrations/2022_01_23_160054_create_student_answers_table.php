<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_answers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('test_id')->unsigned();
            $table->bigInteger('question_id')->unsigned();
            $table->bigInteger('student_id')->unsigned();
            $table->bigInteger('answer_id')->unsigned();
            $table->foreign('test_id')->references('id')->on('test')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('question')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');;
            $table->foreign('answer_id')->references('id')->on('answers')->onDelete('cascade');;

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
        Schema::dropIfExists('student_answers');
    }
}
