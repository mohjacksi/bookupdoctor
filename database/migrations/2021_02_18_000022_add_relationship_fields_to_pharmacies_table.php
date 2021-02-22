<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPharmaciesTable extends Migration
{
    public function up()
    {
        Schema::table('pharmacies', function (Blueprint $table) {
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id', 'city_fk_3188608')->references('id')->on('cities');
        });
    }
}
