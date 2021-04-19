<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id', 'status_fk_3189031')->references('id')->on('appointments_statuses');
            $table->unsignedBigInteger('user_city_id')->nullable();
            $table->foreign('user_city_id', 'user_city_fk_3709746')->references('id')->on('cities');
            $table->unsignedBigInteger('doctor_city_id')->nullable();
            $table->foreign('doctor_city_id', 'doctor_city_fk_3709747')->references('id')->on('cities');
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->foreign('doctor_id', 'doctor_fk_3709748')->references('id')->on('doctors');
        });
    }
}
