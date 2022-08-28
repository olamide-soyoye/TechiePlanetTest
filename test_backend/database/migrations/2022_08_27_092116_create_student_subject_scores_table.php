<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentSubjectScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_subject_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->nullable()
            ->onUpdate('cascade')
            ->onDelete('restrict');
            $table->foreignId('subject_id')->constrained('subjects')->nullable()
            ->onUpdate('cascade')
            ->onDelete('restrict');
            $table->integer('score')->nullable();
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
        Schema::dropIfExists('student_subject_scores');
    }
}
