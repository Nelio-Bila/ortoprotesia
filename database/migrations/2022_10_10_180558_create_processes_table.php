<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('processes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->uuid('address_id');
            $table->foreign('address_id')->references('id')->on('adresses');
            $table->uuid('identification_id');
            $table->foreign('identification_id')->references('id')->on('identifications');
            $table->string("maritalState")->nullable();
            $table->string("genre");
            $table->string("race");
            $table->string("profession")->nullable();
            $table->string("workPlace")->nullable();
            $table->string("naturality");
            $table->string("phoneNumber");
            $table->string("fatherName");
            $table->string("motherName");
            $table->softDeletes();
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
        Schema::dropIfExists('processes');
    }
};
