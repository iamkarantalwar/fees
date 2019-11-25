<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('enquiry_id')->nullable();
            $table->foreign('enquiry_id')->references('id')->on('enquiries')->onDelete('restrict');
            $table->string('relation_type');
            $table->string('gender');
            $table->string('address');
            $table->string('name');
            $table->string('email');
            $table->string('fname');
            $table->unsignedBigInteger('college_id')->nullable();
            // $table->foreign('college_id')->references('id')->on('colleges')->onDelete('restrict');
            $table->string('phoneno');
            $table->string('semester')->nullable();
            $table->string('training_type');
            $table->unsignedBigInteger('degree_id')->nullable();
           // $table->foreign('degree_id')->references('id')->on('degrees')->onDelete('restrict')->nullable();
            $table->string('stream')->nullable();
            $table->string('extra_context')->nullable();
            $table->float('payable_fees',8,2);
            $table->float('discount',8,2);
   
            $table->text('other')->nullable();
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
        Schema::dropIfExists('registrations');
    }
}
