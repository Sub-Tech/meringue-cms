<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePositionColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sections', function (Blueprint $table) {
            $table->dropColumn('order');
            $table->unsignedInteger('position')->nullable();
        });

        Schema::table('blocks', function (Blueprint $table) {
            $table->dropColumn('order');
            $table->unsignedInteger('position')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sections', function (Blueprint $table) {
            $table->dropColumn('position');
            $table->string('order')->nullable();
        });

        Schema::table('blocks', function (Blueprint $table) {
            $table->dropColumn('position');
            $table->string('order')->nullable();
        });
    }
}
