<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentInsurancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipment_insurances', function (Blueprint $table) {
                $table->id();
                $table->string('eway_bill');
                $table->string('insurance_no')->nullable();
                $table->string('insurance_agent')->nullable();
                $table->unsignedBigInteger('shipment_id');
                $table->timestamps(); 

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
        Schema::dropIfExists('shipment_insurances');
    }
}
