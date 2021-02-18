<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDayDoctorPivotTable extends Migration
{
    public function up()
    {
        Schema::create('day_doctor', function (Blueprint $table) {
            $table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id', 'doctor_id_fk_3188805')->references('id')->on('doctors')->onDelete('cascade');
            $table->unsignedBigInteger('day_id');
            $table->foreign('day_id', 'day_id_fk_3188805')->references('id')->on('days')->onDelete('cascade');
        });
    }
}
