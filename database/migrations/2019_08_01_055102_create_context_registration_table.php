<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContextRegistrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('context_registration', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('context_id');
            $table->unsignedBigInteger('registration_id');
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('restrict');
            $table->foreign('registration_id')->references('id')->on('registrations')->onDelete('restrict');
            $table->foreign('context_id')->references('id')->on('contexts')->onDelete('restrict');
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
        Schema::dropIfExists('context_registration');
    }
}
