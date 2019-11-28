<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->char('code', 36)->nullable();
            $table->integer('type_id')->nullable();
            $table->integer('account_no')->nullable();
            $table->string('title', 50)->nullable();
            $table->longtext('post')->nullable();
            $table->string('keywords', 100)->nullable();
            $table->string('status', 20)->nullable();
            $table->dateTime('date_post')->nullable();
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
        Schema::dropIfExists('posts');
    }
}
