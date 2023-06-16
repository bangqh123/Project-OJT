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
            $table->bigIncrements('id');
            $table->string('Name', 50);
            $table->longText('Desc');
            $table->integer('Quantity');
            $table->integer('Price');
            $table->string('image');
            $table->string('Unit');
            $table->timestamps();

            $table->unsignedBigInteger('Category_id');
            $table->foreign('Category_id')->references('id')->on('category')->onDelete('cascade');

            $table->unsignedBigInteger('Supplier_id');
            $table->foreign('Supplier_id')->references('id')->on('supplier')->onDelete('cascade');
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
