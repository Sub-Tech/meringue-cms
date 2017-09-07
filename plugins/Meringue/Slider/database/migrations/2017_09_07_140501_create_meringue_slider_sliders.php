<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeringueSliderSliders extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meringue_slider_sliders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('nav_gallery_id');
            $table->unsignedInteger('main_gallery_id');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meringue_slider_sliders');
    }

}
