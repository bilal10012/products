<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionsTable extends Migration
{
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->json('variant_id')->nullable(); // Store variant IDs as JSON
            $table->unsignedBigInteger('value_id');
            $table->integer('stock')->default(0);
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('value_id')->references('id')->on('product_varient_values')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('options');
    }
}
