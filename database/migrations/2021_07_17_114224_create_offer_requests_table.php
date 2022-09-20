<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_requests', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('offer_id');
            $table->bigInteger('user_id');
            $table->bigInteger('patient_id');
            $table->bigInteger('prescription_id');
            $table->bigInteger('specialist_dr_id');
            $table->enum('status',["pending","processing","complete","cancel"]);
            $table->double('specialist_dr_amount')->nullable();
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
        Schema::dropIfExists('offer_requests');
    }
}
