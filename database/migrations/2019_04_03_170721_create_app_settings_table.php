<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('app_name');
            $table->string('app_logo')->nullable();
            $table->string('app_contact');
            $table->string('app_vat')->nullable();
            $table->string('app_email')->nullable();
            $table->text('app_address')->nullable();
            $table->text('stripe_key')->nullable();
            $table->text('stripe_secret_key')->nullable();
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
        Schema::dropIfExists('app_settings');
    }
}
