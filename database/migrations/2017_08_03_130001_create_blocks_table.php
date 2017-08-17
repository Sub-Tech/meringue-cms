<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blocks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('section_id');
            $table->integer('instance_id');
            $table->string('plugin_class');
            $table->string('order');
            $table->string('background_color')->nullable();
            $table->string('width')->nullable();
            $table->string('padding')->nullable();
            $table->string('border_top')->nullable();
            $table->string('border_right')->nullable();
            $table->string('border_left')->nullable();
            $table->string('border_bottom')->nullable();
            $table->string('custom_css')->nullable();
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
        Schema::dropIfExists('blocks');
    }
}
