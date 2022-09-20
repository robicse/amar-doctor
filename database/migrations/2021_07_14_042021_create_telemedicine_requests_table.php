<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelemedicineRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telemedicine_requests', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('specialist_dr_id');
            $table->bigInteger('user_id');
            $table->bigInteger('patient_id');
            $table->bigInteger('prescription_id');
            $table->double('specialist_dr_amount')->nullable();
            $table->double('doctor_fee')->nullable();
            $table->enum('status',["pending","processing","complete","cancel","refunded"]);
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
        Schema::dropIfExists('telemedicine_requests');
    }
}
