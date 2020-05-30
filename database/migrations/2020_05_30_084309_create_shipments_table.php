<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->string('receiver_name');
            $table->string('receiver_company');
            $table->string('receiver_gst');
            $table->string('receiver_phone');
            $table->string('receiver_secondary_phone');
            $table->string('receiver_email');
            $table->string('receiver_address');
            $table->string('receiver_state');
            $table->string('receiver_pincode');

            $table->string('customer_id');
            $table->string('agency_id');
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
        Schema::dropIfExists('shipments');
    }
}
