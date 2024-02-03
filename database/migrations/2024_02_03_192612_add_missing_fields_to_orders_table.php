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
        Schema::table('orders', function (Blueprint $table) {
            $table->integer('amount_paid_cents'); // Add missing field
            $table->integer('number_of_forms'); // Add missing field
            $table->unsignedBigInteger('user_id'); // Add missing field
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('amount_paid_cents'); // Drop the fields if needed
            $table->dropColumn('number_of_forms');
            $table->dropColumn('user_id');
        });
    }
};
