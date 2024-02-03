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
            // Add the foreign key constraint
            $table->foreign('user_id')
                ->references('id') // Assuming 'id' is the primary key in the 'users' table
                ->on('users')
                ->onDelete('cascade'); // Optional: specify behavior when a user is deleted
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign('orders_user_id_foreign');
        });
    }
};
