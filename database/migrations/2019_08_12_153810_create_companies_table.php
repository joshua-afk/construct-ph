<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->char('code', 36)->nullable();
            $table->string('slug')->nullable();
            $table->string('pcab_license', 20)->nullable();
            $table->integer('user_id')->nullable();
            $table->string('company_name')->nullable();
            $table->string('category')->nullable(); /* A, AA, AAA, AAAA */
            $table->string('type', 25)->nullable();
            $table->string('authorized_managing_officer', 100)->nullable();
            $table->string('street')->nullable();
            $table->integer('region_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->integer('zip_code')->nullable();
            $table->string('longtitude')->nullable();
            $table->string('latitude')->nullable();
            $table->string('address_type')->nullable();
            $table->string('pcab_license_validity')->nullable();
            $table->string('gov_proj_validity')->nullable();
            $table->string('landline')->nullable();
            $table->string('fax_number')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('logo')->nullable();
            $table->string('year_founded')->nullable();
            $table->string('status', 20)->nullable();
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
        Schema::dropIfExists('companies');
    }
}
