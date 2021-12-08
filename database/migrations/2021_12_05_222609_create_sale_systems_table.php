<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_systems', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('amount',12,2)->default(0);
            $table->bigInteger('quantity');
            $table->string('year')->nullable();
            $table->string('mounth')->nullable();
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
        Schema::dropIfExists('sale_systems');
    }
}
