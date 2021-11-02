<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpenseProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expense_products', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('price',12,2)->default(0);
            $table->bigInteger('quantity')->unsigned()->default(0);
            $table->integer('expense_id')->unsigned();
            $table->foreign('expense_id')->references('id')->on('expenses')->onDelete('cascade');;
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
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
        Schema::dropIfExists('expense_products');
    }
}
