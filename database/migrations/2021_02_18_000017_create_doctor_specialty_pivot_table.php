<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorSpecialtyPivotTable extends Migration
{
    public function up()
    {
        Schema::create('doctor_specialty', function (Blueprint $table) {
            $table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id', 'doctor_id_fk_3191503')->references('id')->on('doctors')->onDelete('cascade');
            $table->unsignedBigInteger('specialty_id');
            $table->foreign('specialty_id', 'specialty_id_fk_3191503')->references('id')->on('specialties')->onDelete('cascade');
        });
    }
}
