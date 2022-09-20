<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabTestRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_test_requests', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('patient_id')->nullable();
            $table->bigInteger('lab_id');
            $table->bigInteger('lab_sample_collectors_id')->nullable();
            $table->string('phone');
            $table->integer('address');
            $table->string('test_photo')->nullable();
            $table->longText('details')->nullable();
            $table->double('test_amount')->nullable();
            $table->enum('status',["pending", "processing", "ongoing", "collected","completed"]);
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
        Schema::dropIfExists('lab_test_requests');
    }
}
