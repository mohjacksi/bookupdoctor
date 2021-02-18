<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('location');
            $table->float('stars')->nullable();
            $table->boolean('is_special')->default(0)->nullable();
            $table->boolean('is_active')->default(0)->nullable();
            $table->date('expiration_date')->nullable();
            $table->float('latitude', 8, 5);
            $table->float('longitude', 8, 5);
            $table->longText('about')->nullable();
            $table->string('phone_number');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
