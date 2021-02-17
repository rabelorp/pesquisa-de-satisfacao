<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Transactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) { 
            $table->increments('id');
            $table->integer('id_client')->unsigned();
            $table->integer('id_evaluation')->unsigned();
            $table->integer('id_contributor')->unsigned();
            $table->integer('id_store')->unsigned();
            $table->timestamps(); 
        });

        Schema::table('transactions', function($table) {
            $table->foreign('id_client')->references('id')->on('clients')->nullable();
            $table->foreign('id_evaluation')->references('id')->on('evaluations')->nullable();
            $table->foreign('id_contributor')->references('id')->on('contributors')->nullable();
            $table->foreign('id_store')->references('id')->on('stores')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void 
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
