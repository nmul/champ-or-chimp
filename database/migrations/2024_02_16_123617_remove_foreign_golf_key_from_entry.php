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
        Schema::table('entry', function (Blueprint $table) {
            $table->dropForeign(['golf_1_id']);
            $table->dropForeign(['golf_2_id']);
            $table->dropForeign(['golf_3_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('entry', function (Blueprint $table) {
            $table->foreign('golf_1_id')->references('id')->on('golf');
            $table->foreign('golf_2_id')->references('id')->on('golf');
            $table->foreign('golf_3_id')->references('id')->on('golf');
        });
    }
};
