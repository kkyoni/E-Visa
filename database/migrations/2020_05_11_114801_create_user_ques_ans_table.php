<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserQuesAnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_ques_ans', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('application_id')->nullable();
            $table->string('question_id')->nullable();
            $table->string('answer')->nullable();
            $table->enum('status',['active', 'block'])->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_ques_ans');
    }
}
