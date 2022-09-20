<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelemedicineServiceReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telemedicine_service_reviews', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('telemedicine_requests_id')->nullable();
            $table->bigInteger('specialist_dr_id')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->integer('rating')->nullable();
            $table->longText('comment')->nullable();
            $table->integer('status')->nullable();
            $table->integer('viewed')->nullable();
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
        Schema::dropIfExists('telemedicine_service_reviews');
    }
}
