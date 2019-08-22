<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseEnquiryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_enquiry', function (Blueprint $table) {
            $table->bigIncrements('id');
           
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('enquiry_id');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('restrict');
            $table->foreign('enquiry_id')->references('id')->on('enquiries')->onDelete('restrict');
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
        Schema::dropIfExists('course_enquiry');
    }
}
