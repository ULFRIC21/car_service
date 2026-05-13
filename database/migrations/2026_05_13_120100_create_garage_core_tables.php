<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGarageCoreTables extends Migration
{
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('plate', 32);
            $table->string('brand', 100);
            $table->string('model', 100);
            $table->unsignedSmallInteger('year')->nullable();
            $table->string('vin', 64)->nullable();
            $table->unsignedInteger('mileage')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index(['user_id', 'plate']);
        });

        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->unsignedSmallInteger('duration_minutes')->default(60);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('vehicle_id');
            $table->unsignedBigInteger('mechanic_id')->nullable();
            $table->dateTime('scheduled_at');
            $table->string('status', 32)->default('pending');
            $table->text('client_notes')->nullable();
            $table->text('admin_notes')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
            $table->foreign('mechanic_id')->references('id')->on('users')->nullOnDelete();
            $table->index(['scheduled_at', 'status']);
        });

        Schema::create('appointment_service', function (Blueprint $table) {
            $table->unsignedBigInteger('appointment_id');
            $table->unsignedBigInteger('service_id');
            $table->primary(['appointment_id', 'service_id']);
            $table->foreign('appointment_id')->references('id')->on('appointments')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
        });

        Schema::create('parts', function (Blueprint $table) {
            $table->id();
            $table->string('sku', 64)->unique();
            $table->string('name');
            $table->unsignedInteger('stock_qty')->default(0);
            $table->decimal('unit_price', 10, 2)->default(0);
            $table->timestamps();
        });

        Schema::create('work_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('vehicle_id');
            $table->unsignedBigInteger('appointment_id')->nullable();
            $table->unsignedBigInteger('mechanic_id')->nullable();
            $table->string('status', 32)->default('draft');
            $table->decimal('total_amount', 12, 2)->default(0);
            $table->text('client_visible_notes')->nullable();
            $table->text('internal_notes')->nullable();
            $table->timestamp('opened_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
            $table->foreign('appointment_id')->references('id')->on('appointments')->nullOnDelete();
            $table->foreign('mechanic_id')->references('id')->on('users')->nullOnDelete();
            $table->index(['status']);
        });

        Schema::create('work_order_lines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('work_order_id');
            $table->unsignedBigInteger('service_id')->nullable();
            $table->unsignedBigInteger('part_id')->nullable();
            $table->string('description');
            $table->unsignedInteger('quantity')->default(1);
            $table->decimal('unit_price', 10, 2)->default(0);
            $table->decimal('line_total', 12, 2)->default(0);
            $table->timestamps();
            $table->foreign('work_order_id')->references('id')->on('work_orders')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->nullOnDelete();
            $table->foreign('part_id')->references('id')->on('parts')->nullOnDelete();
        });

        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('work_order_id')->nullable();
            $table->unsignedTinyInteger('rating');
            $table->text('body')->nullable();
            $table->boolean('is_approved')->default(false);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('work_order_id')->references('id')->on('work_orders')->nullOnDelete();
        });

        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('body')->nullable();
            $table->boolean('is_active')->default(true);
            $table->dateTime('starts_at')->nullable();
            $table->dateTime('ends_at')->nullable();
            $table->timestamps();
        });

        Schema::create('callback_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone', 64);
            $table->text('message')->nullable();
            $table->string('status', 32)->default('new');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('callback_requests');
        Schema::dropIfExists('promotions');
        Schema::dropIfExists('reviews');
        Schema::dropIfExists('work_order_lines');
        Schema::dropIfExists('work_orders');
        Schema::dropIfExists('parts');
        Schema::dropIfExists('appointment_service');
        Schema::dropIfExists('appointments');
        Schema::dropIfExists('services');
        Schema::dropIfExists('vehicles');
    }
}
