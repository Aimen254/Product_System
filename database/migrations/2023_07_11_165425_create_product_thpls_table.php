<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductThplsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_thpls', function (Blueprint $table) {
            $table->id();
            $table->integer('product')->default(0);
            $table->integer('threepl')->default(0);
            $table->integer('weightlbs');
            $table->integer('unitperbox');
            $table->integer('boxno');
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
        Schema::dropIfExists('product_thpls');
    }
}
