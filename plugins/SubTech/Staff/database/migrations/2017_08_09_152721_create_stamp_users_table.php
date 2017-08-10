<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStampUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subtech_stamp_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user');
            $table->string('userid');
            $table->string('category');
            $table->string('email');
            $table->string('image')->nullable();
            $table->string('title');
            $table->string('phone_work')->nullable();
            $table->string('description');
            $table->string('skype')->nullable();
            $table->string('linkedin')->nullable();

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
        Schema::dropIfExists('subtech_stamp_users');
    }
}
