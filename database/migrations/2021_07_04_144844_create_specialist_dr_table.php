<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialistDrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specialist_dr', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('designation');
            $table->string('professional_derees')->nullable();
            $table->string('bmdc')->nullable();
            $table->string('experience')->nullable();
            $table->string('rating')->nullable();
            $table->string('nid_pp_no')->nullable();
            $table->string('doctor_code')->nullable();
            $table->double('consultation_fee')->nullable();
            $table->double('follow_up_fee')->nullable();
            $table->string('follow_up_within')->nullable();
            $table->string('availability')->nullable();
            $table->string('consultation_time')->nullable();
            $table->double('discount_percentage')->nullable();
            $table->date('discount_expiry')->nullable();
            $table->string('acc_holder_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('mob_bank_name')->nullable();
            $table->string('mob_bank_number')->nullable();
            $table->string('bank_name')->nullable();
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
        Schema::dropIfExists('specialist_dr');
    }
}
