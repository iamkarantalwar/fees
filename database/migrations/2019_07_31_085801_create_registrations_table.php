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
            $table->bigInteger('enquiry_id')->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('college');
            $table->string('phoneno');
            $table->string('semester');
            $table->string('training_type');
            $table->string('extra_context')->nullable();
            $table->float('fees',8,2);
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
