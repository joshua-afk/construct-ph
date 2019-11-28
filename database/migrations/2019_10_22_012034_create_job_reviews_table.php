<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_id');
            $table->integer('job_entry_id');
            $table->string('role', 10);
            $table->integer('from_id');
            $table->integer('for_id');
            $table->float('rate', 6,1)->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_hidden')->default(true);
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
        Schema::dropIfExists('job_ratings');
    }
}
