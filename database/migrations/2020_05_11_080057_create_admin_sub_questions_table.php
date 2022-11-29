<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminSubQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_sub_questions', function (Blueprint $table) {
            $table->id();
            $table->string('subque_id')->nullable();
            $table->string('sub_question')->nullable();
            $table->string('sub_answer_type')->nullable();
            $table->enum('sub_add_droup',['yes', 'no'])->nullable();
            $table->string('sub_note')->nullable();
            $table->string('sub_tooltip')->nullable();
            $table->string('sub_proceed')->nullable();
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
        Schema::dropIfExists('admin_sub_questions');
    }
}
