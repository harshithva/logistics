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
            $table->string('receiver_gst')->nullable();
            $table->string('receiver_email')->nullable();
            $table->string('receiver_phone');
            $table->string('receiver_secondary_phone')->nullable(); 
            $table->text('receiver_address')->nullable();
            $table->text('receiver_delivery_address')->nullable();
            $table->text('receiver_note')->nullable();
            $table->string('receiver_state')->nullable();
            $table->string('receiver_pincode');
        // package details
            $table->string('package_contact_person')->nullable();
            $table->string('package_contact_person_phone')->nullable();
            $table->string('package_transaction_type')->nullable();
            $table->text('package_pickup_address')->nullable();
        // trasnport details
            $table->string('transport_company_name')->nullable();
            $table->string('transport_company_phone')->nullable();
            $table->string('transport_driver_name')->nullable();
            $table->string('transport_driver_phone')->nullable();
            $table->string('transport_driver_vehicle')->nullable();
            $table->string('user_notes')->nullable();
            $table->string('freight_invoice_number')->nullable();
            // Additional Expenses
            $table->string('charge_transportation')->nullable();
            $table->string('charge_handling')->nullable();
            $table->string('charge_halting')->nullable();
            $table->string('charge_Insurance')->nullable();
            $table->string('charge_odc')->nullable();
            $table->string('charge_tax_percent')->nullable();
            $table->string('charge_tax_amount')->nullable();
            $table->decimal('charge_total',10,2)->default(0);

            $table->unsignedBigInteger('customer_id');
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
        Schema::dropIfExists('shipments');
    }
}
