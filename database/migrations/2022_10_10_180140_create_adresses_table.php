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
        Schema::create('adresses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('province_id');
            $table->foreign('province_id')->references('id')->on('provinces');
            $table->uuid('district_id');
            $table->foreign('district_id')->references('id')->on('districts');
            $table->uuid('neighbourhood_id');
            $table->foreign('neighbourhood_id')->references('id')->on('neighbourhoods');
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
        Schema::dropIfExists('adresses');
    }
};
