<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryManRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_man_requests', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('delivery_man_id');
            $table->string('user_id');
            $table->string('user_name')->nullable();
            $table->string('user_phone')->nullable();
            $table->longText('user_address')->nullable();
            $table->integer('prescription_id');
            $table->double('delivery_charge')->nullable();
            $table->string('is_prescription_photo')->nullable();
            $table->double('delivery_man_cost')->nullable();
            $table->enum('status',["pending","processing","complete","cancel","refunded"]);
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
        Schema::dropIfExists('delivery_man_requests');
    }
}
