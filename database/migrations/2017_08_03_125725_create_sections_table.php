<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('page_id');
            $table->string('order');
            $table->string('background_color')->nullable();
            $table->string('padding')->nullable();
            $table->string('foreground_color')->nullable();
            $table->string('border_top')->nullable();
            $table->string('border_right')->nullable();
            $table->string('border_left')->nullable();
            $table->string('border_bottom')->nullable();
            $table->string('custom_css')->nullable();
            $table->integer('container')->default(1);
            $table->integer('active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sections');
    }
}
