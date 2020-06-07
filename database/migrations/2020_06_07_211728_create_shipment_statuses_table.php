<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipment_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->string('location')->nullable();
            $table->string('receiver_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('document')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('shipment_id');
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');          
            $table->foreign('shipment_id')->references('id')->on('shipments')->onDelete('cascade');          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipment_statuses');
    }
}
