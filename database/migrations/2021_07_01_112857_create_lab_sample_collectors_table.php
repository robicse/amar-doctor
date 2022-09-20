<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabSampleCollectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_sample_collectors', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('lab_id')->unsigned();
            $table->string('name',255)->nullable();
            $table->string('email',255)->nullable();
            $table->string('phone',255)->nullable();
            $table->string('address',255)->nullable();
            $table->foreign('lab_id')->references('id')->on('labs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_sample_collectors');
    }
}
