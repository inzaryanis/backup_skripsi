<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_address', function (Blueprint $table) {
            $table->BigIncrements('id',20);
            $table->unsignedBigInteger('id_customer');
            $table->foreign('id_customer')->references('id')->on('customer');
            $table->unsignedBigInteger('id_office_type')->nullable();
            $table->foreign('id_office_type')->references('id')->on('office_type');
            $table->string('address_text')->nullable();
            $table->string('first_address_line')->nullable();
            $table->string('second_address_line')->nullable();
            $table->string('third_address_line')->nullable();
            $table->string('city_area')->nullable();
            $table->string('postal_zip_code')->nullable();
            $table->string('country_area')->nullable();
            $table->string('active_ind')->default('Y');
            $table->string('created_by',50);
            $table->string('updated_by',50)->nullable();
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
        Schema::dropIfExists('customer_address');
    }
}
