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
           
            $table->string('name');
            $table->string('email');
            $table->unsignedBigInteger('college_id');
            // $table->foreign('college_id')->references('id')->on('colleges')->onDelete('restrict');
            $table->string('phoneno');
            $table->string('semester');
            $table->string('training_type');
            $table->unsignedBigInteger('degree_id');
            $table->foreign('degree_id')->references('id')->on('degrees')->onDelete('restrict');
            $table->string('stream');
            $table->string('extra_context')->nullable();
            $table->float('payable_fees',8,2);
            $table->float('discount',8,2);
            $table->float('extra_charges',8,2);
            $table->text('narration');
            $table->string('refrence')->nullable();
            $table->float('total_fees',8,2);
            $table->String('reciept_no');
            $table->float('registration_amount',8,2);
            $table->float('due_fees',8,2);
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
