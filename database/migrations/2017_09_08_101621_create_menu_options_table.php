<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_options', function (Blueprint $table) {
            $table->increments('id');

            $table->string('text');
            $table->string('href')->nullable()->default('#');
            $table->unsignedInteger('page')->nullable();
            $table->unsignedInteger('parent_id')->nullable();

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
        Schema::dropIfExists('menu_options');
    }
}
