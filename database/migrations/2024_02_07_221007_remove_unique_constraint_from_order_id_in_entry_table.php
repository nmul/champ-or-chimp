<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('entry', function (Blueprint $table) {
            // Remove the unique constraint on the order_id column
            $table->dropUnique('entry_order_id_unique'); // Assuming this is the constraint name
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
            // Re-add the unique constraint if needed
            $table->unique('order_id');
        });
    }
};
