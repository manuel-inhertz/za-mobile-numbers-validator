<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMobileNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobile_numbers', function (Blueprint $table) {
            $table->bigIncrements('id'); // Incremental ID Primary-key
            $table->string('number'); // Phone number
            $table->boolean('correctness'); // True/False weather the number is correct or not
            $table->string('notes')->nullable(); // Notes - eg: what was modified
            $table->timestamps(); // Date-time of creation
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mobile_numbers');
    }
}
