<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_contact', function (Blueprint $table) {
            $table->BigIncrements('id',20);
            $table->unsignedBigInteger('id_customer');
            $table->foreign('id_customer')->references('id')->on('customer');
            $table->unsignedBigInteger('id_customer_address');
            $table->foreign('id_customer_address')->references('id')->on('customer_address');
            $table->unsignedBigInteger('id_contact_type')->nullable();
            $table->foreign('id_contact_type')->references('id')->on('contact_type');
            $table->string('person_name')->nullable();
            $table->unsignedBigInteger('id_religion')->nullable();
            $table->foreign('id_religion')->references('id')->on('religion');
            $table->string('gender')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('phone_mobile')->nullable();
            $table->string('phone_fixed')->nullable();
            $table->string('email_address')->nullable();
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
        Schema::dropIfExists('customer_contact');
    }
}
