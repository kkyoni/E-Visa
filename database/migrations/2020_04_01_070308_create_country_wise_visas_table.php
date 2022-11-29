<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountryWiseVisasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('country_wise_visas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('country_id')->nullable();
            $table->string('visa_type_id')->nullable();
            $table->string('country_from_id')->nullable();
            $table->string('visa_type_entry_id')->nullable();
            $table->string('visa_validity')->nullable();
            $table->string('stay_validity')->nullable();
            $table->string('regular_service_cost')->nullable();
            $table->string('express_service_cost')->nullable();
            $table->string('express_gov_fee')->nullable();
            $table->string('regular_gov_fee')->nullable();
            $table->string('regular_service_type')->nullable();
            $table->string('express_service_type')->nullable();
            $table->longText('information')->nullable();
            $table->longText('required_docs')->nullable();
            $table->enum('favourite_status',['0','1'])->default('0')->comment('1=favourite and 0=notfavourite')->nullable();
            $table->enum('status',['active','inactive'])->default('active')->nullable();
            $table->string('processing_days')->nullable();
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
        Schema::dropIfExists('country_wise_visas');
    }
}
