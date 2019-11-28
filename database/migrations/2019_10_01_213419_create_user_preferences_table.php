<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_preferences', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id')->nullable();
            $table->text('summary')->nullable();
            $table->boolean('relocation')->default(0);
            $table->boolean('full_time')->default(0);
            $table->boolean('part_time')->default(0);
            $table->boolean('temporary')->default(0);
            $table->boolean('contract')->default(0);
            $table->boolean('internship')->default(0);
            $table->boolean('commission')->default(0);
            $table->boolean('new_grad')->default(0);
            $table->string('privacy')->default('public');
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
        Schema::dropIfExists('resume_profiles');
    }
}
