<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->string('customer_name')->nullable();
            $table->string('email')->nullable();
            $table->string('contact')->nullable();
            $table->string('delivery_times')->nullable();
            $table->text('delivery_address')->nullable();
            $table->text('stripe_id')->nullable();
            $table->text('stripe_charge_id')->nullable();
            $table->text('stripe_details')->nullable();
            $table->text('stripe_card')->nullable();
            $table->integer('total_product')->default(0);
            $table->decimal('sub_total',8,2)->default(0);
            $table->decimal('tax',8,2)->default(0);
            $table->decimal('total',8,2)->default(0);
            $table->integer('status')->default(0);
            $table->unsignedInteger('created_by') -> nullable() -> default(null);
            $table->unsignedInteger('updated_by') -> nullable() -> default(null);
            $table->unsignedInteger('deleted_by') -> nullable() -> default(null);
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
        Schema::dropIfExists('orders');
    }
}
