<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryManTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_mans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->double('admin_will_pay')->nullable();
            $table->string('bank_name');
            $table->string('acc_holder_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('nid_pp_no')->nullable();
            $table->string('mob_bank_name')->nullable();
            $table->string('mob_bank_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_man');
    }
}
