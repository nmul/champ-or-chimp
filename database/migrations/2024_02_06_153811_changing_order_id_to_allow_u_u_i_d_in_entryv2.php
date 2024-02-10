<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('entry', function (Blueprint $table) {
            // Change the data type of order_id to VARCHAR(255)
            $table->string('order_id', 255)->change();
    
            // If existing data is present, consider migrating it to UUIDs:
            // $table->uuid('order_id')->unique()->change(); // Replace with your migration logic
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('entry', function (Blueprint $table) {
            $table->char('order_id', 36)->change();
        });
    }
};