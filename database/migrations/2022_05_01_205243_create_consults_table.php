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
        Schema::create('consults', function (Blueprint $table) {
            $table->id();
            $table->string("type");
            $table->boolean("accomplished")->default(false);
            $table->unsignedBigInteger('process_id');
            $table->foreign('process_id')->references('id')->on('processes');
            $table->unsignedBigInteger('consult_date_id');
            $table->foreign('consult_date_id')->references('id')->on('consult_dates');
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
        Schema::dropIfExists('consults');
    }
};