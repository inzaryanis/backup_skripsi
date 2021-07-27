<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterPartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_part', function (Blueprint $table) {
            $table->id();
            $table->string('part')->unique;
            $table->unsignedBigInteger('id_series');
            $table->foreign('id_series')->references('id')->on('series');
            $table->unsignedBigInteger('id_type');
            $table->foreign('id_type')->references('id')->on('type');
            $table->unsignedBigInteger('id_merk');
            $table->foreign('id_merk')->references('id')->on('merk');
            $table->string('serialized_code')->default('N');
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
        Schema::dropIfExists('master_part');
    }
}
