<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->char('code', 36);
            $table->string('username', 20);
            $table->string('email', 100);
            $table->longtext('password')->nullable();
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->longtext('image')->nullable();
            $table->dateTime('birthdate')->nullable();
            $table->string('mobile_number', 20)->nullable();
            $table->string('phone_number', 20)->nullable();
            $table->string('fax_number', 30)->nullable();
            $table->integer('region_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->integer('zip')->nullable();
            $table->integer('type')->nullable();
            $table->string('status', 20)->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamp('is_activated')->nullable();
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
        Schema::dropIfExists('accounts');
    }
}
