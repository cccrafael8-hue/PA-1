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
        Schema::table('galleries', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
        });

        // Set existing galleries to belong to an admin user to prevent constraint failures
        $admin = \Illuminate\Support\Facades\DB::table('users')->where('role', 'admin')->first();
        if (!$admin) {
            $admin = \Illuminate\Support\Facades\DB::table('users')->first();
        }

        if ($admin) {
            \Illuminate\Support\Facades\DB::table('galleries')->update(['user_id' => $admin->id]);
        }

        Schema::table('galleries', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('galleries', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
