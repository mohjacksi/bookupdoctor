<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePharmaciesTable extends Migration
{
    public function up()
    {
        Schema::create('pharmacies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('location');
            $table->float('longitude', 8, 5);
            $table->float('latitude', 8, 5);
            $table->boolean('is_special')->default(0)->nullable();
            $table->boolean('is_active')->default(0)->nullable();
            $table->date('expiration_date')->nullable();
            $table->string('phone_number');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
