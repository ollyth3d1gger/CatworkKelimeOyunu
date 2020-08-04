<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config', function (Blueprint $table) {
            $table->increments('id');
            $table->string('MAIL_FROM_NAME');
            $table->string('MAIL_DRIVER');
            $table->string('MAIL_HOST');
            $table->string('MAIL_PORT');
            $table->string('MAIL_USERNAME');
            $table->string('MAIL_FROM_ADDRESS');
            $table->string('MAIL_PASSWORD');
            $table->string('MAIL_ENCRYPTION')->nullable();
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
        Schema::dropIfExists('config');
    }
}
