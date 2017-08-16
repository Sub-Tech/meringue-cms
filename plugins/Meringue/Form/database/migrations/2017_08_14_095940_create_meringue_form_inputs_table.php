<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeringueFormInputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meringue_form_inputs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('form_id');
            $table->enum('type', [
                'text',
                'textarea',
                'select',
                'radio',
                'checkbox'
            ]);
            $table->string('name')->required();
            $table->string('label')->required();
            $table->string('options')->nullable();
            $table->unsignedInteger('position');

            $table->boolean('required');
            $table->string('validation');

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
        Schema::dropIfExists('meringue_form_inputs');
    }
}
