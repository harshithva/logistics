<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_type')->default('cash');
            $table->decimal('amount',10,2)->default(0);
 
            $table->date('payment_date')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('upi_ref_id')->nullable();
            $table->string('cheque_no')->nullable();

            $table->unsignedBigInteger('shipment_id');
            $table->unsignedBigInteger('customer_id');
            $table->foreign('shipment_id')->references('id')->on('shipments')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('payments');
    }
}
