<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_invitations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_id');
            $table->integer('entity_type');
            $table->integer('entity_id');
            $table->string('status')->default('pending'); // TYPES: pending, accepted, declined.
            $table->boolean('is_viewed')->default(0);
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
        Schema::dropIfExists('job_invitations');
    }
}
