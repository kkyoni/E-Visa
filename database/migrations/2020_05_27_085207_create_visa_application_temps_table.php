<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisaApplicationTempsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visa_application_temps', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
            $table->string('whatapp_number')->nullable();
            $table->string('arrival_date')->nullable();
            $table->string('departure_date')->nullable();
            $table->string('from_country_id')->nullable();
            $table->string('destination_country_id')->nullable();
            $table->string('visa_type_id')->nullable();
            $table->string('visa_entry_id')->nullable();
            $table->string('service_type')->nullable();
            $table->string('total_price')->nullable();
            $table->string('gov_fee')->nullable();
            $table->string('tax')->nullable();
            $table->enum('app_status',['pending','completed'])->default('pending');
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
        Schema::dropIfExists('visa_application_temps');
    }
}
