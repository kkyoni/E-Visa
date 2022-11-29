<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_details', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('card_type',191)->nullable()->index();
            $table->string('card_number',191)->nullable()->index();
            $table->string('card_holder_name',191)->nullable();
            $table->string('card_expiry_month',191)->nullable();
            $table->string('card_expiry_year',191)->nullable();
            $table->string('card_name',191)->nullable();
            $table->string('cvv',191)->nullable();
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
        Schema::dropIfExists('card_details');
    }
}
