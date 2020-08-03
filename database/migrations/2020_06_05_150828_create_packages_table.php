<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
    
            $table->longText('description')->nullable();
            $table->string('serial_no')->nullable();
            $table->string('invoice_no')->nullable();
            $table->string('size')->nullable();
            $table->string('weight')->nullable();
            $table->string('quantity')->nullable();
            $table->string('cost')->default(0);
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
        Schema::dropIfExists('packages');
    }
}
