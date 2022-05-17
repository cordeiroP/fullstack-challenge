<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('contactName',100);
            $table->bigInteger('contactPhone');
            $table->String('realState',100);
            $table->String('description');
            $table->String('company',100);
            $table->unsignedBigInteger('category_id');
            $table->date('deadline');
            $table->timestamps();
        });
        Schema::table('order', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('category')->onDelete('cascade')->onUpdate('cascade');
           });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}
