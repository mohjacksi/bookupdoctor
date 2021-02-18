<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDayPharmacyPivotTable extends Migration
{
    public function up()
    {
        Schema::create('day_pharmacy', function (Blueprint $table) {
            $table->unsignedBigInteger('pharmacy_id');
            $table->foreign('pharmacy_id', 'pharmacy_id_fk_3188863')->references('id')->on('pharmacies')->onDelete('cascade');
            $table->unsignedBigInteger('day_id');
            $table->foreign('day_id', 'day_id_fk_3188863')->references('id')->on('days')->onDelete('cascade');
        });
    }
}
