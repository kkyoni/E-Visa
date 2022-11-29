<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisaApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visa_applicants', function (Blueprint $table) {
            $table->id();
            $table->string('application_id')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('gender')->nullable();
            $table->string('nationality')->nullable();
            $table->string('birthdate')->nullable();
            $table->string('birth_country')->nullable();
            $table->string('resident_country')->nullable();
            $table->string('visa_entry_id')->nullable();
            $table->string('passport_number')->nullable();
            $table->string('passport_issue_date')->nullable();
            $table->string('passport_expiry_date')->nullable();
            $table->text('passport_image')->nullable();
            $table->text('applicant_image')->nullable();
            $table->enum('status',['pending','in-progress','approved','completed','rejected','waiting_for_gov'])->default('pending');
            $table->text('reason')->nullable();
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
        Schema::dropIfExists('visa_applicants');
    }
}
