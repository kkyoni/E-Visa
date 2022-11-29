<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountryVisaFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('country_visa_fees', function (Blueprint $table) {
            $table->id();
            $table->string('country_visa_id')->nullable();
            $table->string('visa_type_entry_id')->nullable();
            $table->string('regular_gov_fee')->nullable();
            $table->string('express_gov_fee')->nullable();
            $table->string('regular_service_type')->nullable();
            $table->string('visa_validity')->nullable();
            $table->string('stay_validity')->nullable();
            $table->string('service_fee')->nullable();
            $table->string('processing_time')->nullable();
            $table->string('vat_tax')->nullable();
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
        Schema::dropIfExists('country_visa_fees');
    }
}
