<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->char('code', 36);
            $table->integer('entity_type');
            $table->integer('entity_id');
            $table->string('title');
            $table->text('description');
            $table->integer('region_id');
            $table->integer('city_id');
            $table->integer('zip');
            $table->integer('salary_min');
            $table->integer('salary_max');
            $table->integer('hire_count');
            $table->varchat('status')->default('hiring');
            $table->timestamp('deadline')->nullable();
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
        Schema::dropIfExists('jobs');
    }
}
