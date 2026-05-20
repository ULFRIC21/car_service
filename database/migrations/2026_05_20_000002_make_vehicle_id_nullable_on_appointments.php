<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MakeVehicleIdNullableOnAppointments extends Migration
{
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign(['vehicle_id']);
        });

        DB::statement('ALTER TABLE `appointments` MODIFY `vehicle_id` BIGINT UNSIGNED NULL');

        Schema::table('appointments', function (Blueprint $table) {
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign(['vehicle_id']);
        });

        DB::statement('ALTER TABLE `appointments` MODIFY `vehicle_id` BIGINT UNSIGNED NOT NULL');

        Schema::table('appointments', function (Blueprint $table) {
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('restrict');
        });
    }
}
