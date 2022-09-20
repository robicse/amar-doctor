<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeServiceRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_service_requests', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->integer('secmo_dr_id');
            $table->enum('secmo_dr_status',["pending","processing","complete"]);
            $table->enum('status',["pending","processing","complete","cancel"]);
            $table->double('amount');
            $table->double('decmo_dr_amount')->nullable();
            $table->enum('payment_type',["cash","online_payment"]);
            $table->double('specialist_dr_amount');
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
        Schema::dropIfExists('home_service_requests');
    }
}
