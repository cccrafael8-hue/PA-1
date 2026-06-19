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
        Schema::table('reviews', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
        });

        // Map existing reviews to user_id based on name to preserve dummy data
        $reviews = \Illuminate\Support\Facades\DB::table('reviews')->get();
        $fallbackUser = \Illuminate\Support\Facades\DB::table('users')->first();

        foreach ($reviews as $review) {
            $user = \Illuminate\Support\Facades\DB::table('users')->where('name', $review->name)->first();
            $userId = $user ? $user->id : ($fallbackUser ? $fallbackUser->id : null);
            
            if ($userId) {
                \Illuminate\Support\Facades\DB::table('reviews')
                    ->where('id', $review->id)
                    ->update(['user_id' => $userId]);
            }
        }

        Schema::table('reviews', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
