<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('user_id');
            $table->double('amount');
            $table->double('charge');
            $table->string('trx');
            $table->double('final_amount');
            $table->text('withdraw_information')->nullable();
            $table->enum('status',["pending","complete","reject"]);
            $table->text('admin_feedback')->nullable();
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
        Schema::dropIfExists('withdrawals');
    }
}
