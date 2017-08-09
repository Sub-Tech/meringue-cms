<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlockRegistryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('block_registries', function (Blueprint $table) {
            $table->string('plugin_class')->unique();
            $table->string('name');
            $table->string('description');
            $table->string('icon');
            $table->string('inputs')->nullable();
            $table->timestamps();
            $table->primary('plugin_class');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('block_registries');
    }
}
