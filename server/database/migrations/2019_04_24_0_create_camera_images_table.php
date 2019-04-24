<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCameraImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('camera_images', function (Blueprint $table) {
          $table->increments('id');
          $table->timestamps();
          $table->string('camera_image_file_type',50)->nullable($value = true);
          $table->string('camera_image_file_name',50)->nullable($value = true);
          $table->longText('camera_image_file')->nullable($value = true);
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::dropIfExists('camera_images');
    }
}