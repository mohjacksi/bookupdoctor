<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsStatusesTable extends Migration
{
    public function up()
    {
        Schema::create('appointments_statuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('color');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
