<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecmoDrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('secmo_dr', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('designation');
            $table->double('cash_to_pay_admin');
            $table->string('bmdc_number');
            $table->string('professional_degree');
            $table->string('experience');
            $table->string('current_employment');
            $table->string('nid_pp_no');
            $table->string('bank_name')->nullable();
            $table->string('acc_holder_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('mob_bank_name');
            $table->string('mob_bank_number');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('secmo_dr');
    }
}
