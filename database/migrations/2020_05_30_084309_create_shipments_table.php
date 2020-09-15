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
      
            $table->text('delivery_address')->nullable();
          
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
            $table->longText('user_notes')->nullable();
            $table->string('freight_invoice_number')->nullable();
            // Additional Expenses
            $table->decimal('charge_transportation',10,2)->nullable();
            $table->decimal('charge_handling',10,2)->nullable();
            $table->decimal('charge_halting',10,2)->nullable();
            $table->decimal('charge_Insurance',10,2)->nullable();
            $table->decimal('charge_odc',10,2)->nullable();
            $table->decimal('charge_tax_percent',10,2)->nullable();
            $table->decimal('charge_tax_amount',10,2)->nullable();
            $table->decimal('charge_total',10,2)->default(0);
            $table->decimal('charge_advance_paid',10,2)->nullable();
            $table->decimal('charge_balance',10,2)->nullable();
        //    extra
            $table->string('vendor')->nullable();
            $table->string('payment_type')->nullable();
            $table->text('remarks')->nullable();
            $table->string('document')->nullable();
            $table->string('bill_to')->nullable();
            $table->string('docket_no')->nullable();
            $table->date('date')->nullable();


            $table->unsignedBigInteger('sender_id');
            $table->unsignedBigInteger('receiver_id');
            $table->unsignedBigInteger('bill_to_id');
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('bill_to_id')->references('id')->on('users')->onDelete('cascade');
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
