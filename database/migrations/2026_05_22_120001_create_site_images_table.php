<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteImagesTable extends Migration
{
    public function up()
    {
        Schema::create('site_images', function (Blueprint $table) {
            $table->id();
            $table->string('group', 32)->default('page');
            $table->string('slot', 64);
            $table->string('file_path', 255);
            $table->string('alt', 255)->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();

            $table->unique(['group', 'slot']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('site_images');
    }
}
