<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('restrict');
            $table->foreignId('vehicle_id')->constrained()->onDelete('restrict');
            $table->foreignId('service_id')->constrained()->onDelete('restrict');
            $table->foreignId('mechanic_id')->nullable()->constrained('users')->onDelete('set null');
            $table->dateTime('scheduled_at');
            $table->string('status', 20)->default('pending');
            $table->text('client_comment')->nullable();
            $table->text('admin_comment')->nullable();
            $table->decimal('price_at_booking', 10, 2)->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
