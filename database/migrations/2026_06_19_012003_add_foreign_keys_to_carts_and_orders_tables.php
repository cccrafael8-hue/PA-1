<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Reassign user_id yang tidak valid
        $fallbackUser = DB::table('users')->first();

        if ($fallbackUser) {
            DB::table('orders')
                ->whereNotNull('user_id')
                ->whereNotIn('user_id', function ($query) {
                    $query->select('id')->from('users');
                })
                ->update([
                    'user_id' => $fallbackUser->id
                ]);
        } else {
            DB::table('orders')->truncate();
        }

        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
    }
};