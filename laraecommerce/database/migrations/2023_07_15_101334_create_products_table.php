<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->unsignedBigInteger('category_id');
            $table->string('name');
            $table->string('slug');
            $table->string('brand')->nullable();
            $table->mediumText('small_description')->nullable();
            $table->longText('description')->nullable();

            $table->integer('orignal_price');
            $table->integer('selling_price');
            $table->integer('quantity');
            $table->tinyInteger('trending')->default('0')->comment('1=trending, 0=not-trending');
            $table->tinyInteger('electronics')->default('0')->comment('1=selected, 0=not-selected');
            $table->tinyInteger('Stationary')->default('0')->comment('1=Stationary, 0=not-in-Stationary');
            $table->tinyInteger('accessories')->default('1')->comment('1=accessories, 0=not-a-accessories');
            $table->tinyInteger('homedecore')->default('1')->comment('1=homedecore, 0=not-a-homedecore');

            $table->tinyInteger('status')->default('0')->comment('1=hidden, 0=visible');

            $table->string('meta_title')->nullable();
            $table->mediumText('meta_keyword')->nullable();
            $table->mediumText('meta_description')->nullable();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
};
