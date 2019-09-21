<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enquiries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->bigInteger('phone_no');
            $table->string('email');
            $table->string('semester');
            $table->unsignedBigInteger('college_id');
            // $table->foreign('college_id')->references('id')->on('colleges')->onDelete('restrict');
            $table->unsignedBigInteger('degree_id');
            $table->foreign('degree_id')->references('id')->on('degrees')->onDelete('restrict');
            $table->unsignedBigInteger('duration_id'); 
            $table->foreign('duration_id')->references('id')->on('durations')->onDelete('restrict');
            $table->string('stream');
            $table->text('narration');  
            $table->string('refrence')->nullable();      
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
        Schema::dropIfExists('enquiries');
    }
}
