<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeringueFormFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meringue_form_forms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('route')->required();
            $table->string('name')->required();
            $table->enum('verb', [
                'GET',
                'POST'
            ]);
            $table->boolean('validation');

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
        Schema::dropIfExists('meringue_form_forms');
    }
}