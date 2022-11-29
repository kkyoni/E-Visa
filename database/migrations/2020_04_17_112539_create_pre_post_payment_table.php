<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrePostPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pre_post_payment', function (Blueprint $table) {
            $table->id();
            $table->string('u_id')->nullable();
            $table->string('question')->nullable();
            $table->string('answer')->nullable();
            $table->enum('answer_type',['text', 'drop-down', 'datepicker'])->nullable();
            $table->enum('add_droup',['yes','no'])->nullable();
            $table->string('note')->nullable();
            $table->string('tooltip')->nullable();
            $table->enum('payment_status',['pre','post'])->nullable();
            $table->enum('status',['active','block'])->default('active');
            $table->enum('proceed',['0','1'])->nullable();
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
        Schema::dropIfExists('pre_post_payment');
    }
}
