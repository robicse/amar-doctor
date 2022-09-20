<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->enum('user_type',["admin","stuff","patient","secmo_dr","specialist_dr","delivery_man"]);
            $table->string('district_id');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->text('verification_code')->nullable();
            $table->text('new_email_verificiation_code')->nullable();
            $table->string('password')->nullable();
            $table->string('remember_token')->nullable();
            $table->string('gender')->nullable();
            $table->date('dob');
            $table->string('avatar')->nullable();
            $table->string('avatar_original')->nullable();
            $table->string('address')->nullable();
            $table->string('area')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude');
            $table->double('balance');
            $table->tinyInteger('banned');
            $table->tinyInteger('view');
            $table->string('referral_code')->nullable();
            $table->integer('referred_by')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
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
