<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->integer('price');
            $table->double('discount');
            $table->integer('stock');
            $table->string('image');
            $table->string('keyword');
            $table->text('description')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->integer('hits')->default(0);
            $table->tinyInteger('publish')->comment('0=unpublish,1=publish')->default(1);
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
        Schema::dropIfExists('products');
    }
}
