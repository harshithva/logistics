<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email');
            $table->string('name');
            $table->string('type')->nullable();
            $table->string('contact')->nullable();
            $table->string('source')->nullable();
            $table->string('region')->nullable();
            $table->string('country')->nullable();
            $table->decimal('potential_opportunity')->nullable();
            $table->decimal('chance_of_sale')->nullable();
            $table->string('forecast_close')->nullable();
            $table->decimal('weighted_forecast')->nullable();
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
        Schema::dropIfExists('leads');
    }
}
