<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('callings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('status');
            $table->String('narration');
            $table->bigInteger('enquiry_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('callings');
    }
}
