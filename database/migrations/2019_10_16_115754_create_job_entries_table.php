<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * @var    company ( boolean ) true if the entry is company false if not.
     * @var    professional ( boolean ) true if the entry is professional false if not.
     */
    
    public function up()
    {
        Schema::create('job_entries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_id');
            $table->integer('entity_type');
            $table->integer('entity_id');
            $table->text('proposal')->nullable();
            $table->string('status')->default('pending'); // (pending, rejected, accepted)
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
        Schema::dropIfExists('job_entries');
    }
}
