<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->BigIncrements('id');
            $table->string('name');
            $table->string('short_name');
            $table->unsignedBigInteger('id_business_type')->nullable();
            $table->foreign('id_business_type')->references('id')->on('business_type');
            $table->unsignedBigInteger('id_business_conduct')->nullable();
            $table->foreign('id_business_conduct')->references('id')->on('business_conduct');
            $table->string('npwp')->nullable()->unique;
            $table->string('remarks')->nullable();
            $table->string('active_ind')->default('Y');
            $table->string('control_by')->default('IU');
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
        Schema::dropIfExists('customer');
    }
}
