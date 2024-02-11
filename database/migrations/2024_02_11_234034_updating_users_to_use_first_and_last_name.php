<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the existing "name" column if present (optional)
            if (Schema::hasColumn('users', 'name')) {
                $table->dropColumn('name');
            }

            // Add new columns for first and last names
            $table->string('first_name', 255)->nullable();
            $table->string('last_name', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Add back the old "name" column (optional)
            if (!Schema::hasColumn('users', 'name')) {
                $table->string('name', 255)->nullable();
            }

            // Drop the new columns
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
        });
    }
};
