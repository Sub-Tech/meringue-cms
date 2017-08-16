<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePluginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plugins', function (Blueprint $table) {
            $table->string('class_name')->unique();
            $table->string('file_name');
            $table->string('vendor');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('author')->nullable();
            $table->string('icon')->nullable();
            $table->integer('active')->default(0);
            $table->integer('installed')->default(0);
            $table->timestamps();

            $table->primary('class_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plugins');
    }
}
