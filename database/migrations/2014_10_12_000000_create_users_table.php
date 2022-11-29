<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('encrypt_password')->nullable();
            $table->text('user_photo')->nullable();
            $table->text('passport_photo')->nullable();
            $table->enum('user_type',['superadmin','user','bo_user'])->default('user');
            $table->string('language')->nullable();
            $table->string('avatar')->nullable();
            $table->string('unique_id')->nullable();
            $table->enum('status',['active','block'])->default('active');
            $table->string('ref_id')->nullable();
            $table->string('role_id')->nullable()->default(2);
            $table->string('mobile')->nullable();
            $table->string('passport')->nullable();
            $table->string('passport_issue_date')->nullable();
            $table->string('passport_expiry_date')->nullable();
            $table->string('wpmobile')->nullable();
            $table->enum('social_status',['facebook', 'google', 'web'])->default('web');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('avatar_date')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
