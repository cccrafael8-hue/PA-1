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
        // Reassign invalid user_ids to a valid user to prevent constraint failure and save dummy data
        $fallbackUser = \Illuminate\Support\Facades\DB::table('users')->first();
        if ($fallbackUser) {
            \Illuminate\Support\Facades\DB::table('orders')
                ->whereNotNull('user_id')
                ->whereNotIn('user_id', function($query) {
                    $query->select('id')->from('users');
                })
                ->update(['user_id' => $fallbackUser->id]);
        } else {
            \Illuminate\Support\Facades\DB::table('orders')->truncate();
        }

        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
    }
};
