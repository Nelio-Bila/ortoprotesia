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
            $table->uuid('id')->primary();
            $table->boolean('accomplished')->default(false);
            $table->uuid('process_id');
            $table->foreign('process_id')->references('id')->on('processes');
            $table->uuid('consult_session_id');
            $table->foreign('consult_session_id')->references('id')->on('consult_sessions');
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
