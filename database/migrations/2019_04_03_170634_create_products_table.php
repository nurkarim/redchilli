<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('food_menus_id')->nullable();
            $table->string('name');
            $table->text('details')->nullable();
            $table->decimal('price',8,2)->default(0);
            $table->string('image')->nullable();
            $table->unsignedInteger('created_by') -> nullable() -> default(null);
            $table->unsignedInteger('updated_by') -> nullable() -> default(null);
            $table->unsignedInteger('deleted_by') -> nullable() -> default(null);
            $table->timestamps();
            $table->foreign('category_id')
                  ->references('id')->on('categories')
                  ->onDelete('cascade');
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
