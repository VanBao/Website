<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('category_id');
            $table->string('name');
            $table->string('unsigned_name');
            $table->text('description');
            $table->unsignedInteger('price');
            $table->string('path');
            $table->unsignedInteger('promotion');
            $table->unsignedInteger('view')->default(0);
            $table->boolean('status')->default(0);
            $table->tinyInteger('expiry_date');
            $table->integer('weight');
            $table->string("origin");
            $table->integer('vote')->default(0);
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
        Schema::dropIfExists('product');
    }
}
