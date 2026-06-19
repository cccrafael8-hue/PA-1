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
        Schema::table('menus', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
        });

        Schema::table('cart_items', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
        });

        // 1. Assign existing menus to an admin user
        $admin = \Illuminate\Support\Facades\DB::table('users')->where('role', 'admin')->first();
        if (!$admin) {
            $admin = \Illuminate\Support\Facades\DB::table('users')->first();
        }

        if ($admin) {
            \Illuminate\Support\Facades\DB::table('menus')->update(['user_id' => $admin->id]);
        }

        // 2. Assign existing cart_items to the user of their respective carts
        $cartItems = \Illuminate\Support\Facades\DB::table('cart_items')->get();
        foreach ($cartItems as $item) {
            $cart = \Illuminate\Support\Facades\DB::table('carts')->where('id', $item->cart_id)->first();
            if ($cart && $cart->user_id) {
                \Illuminate\Support\Facades\DB::table('cart_items')
                    ->where('id', $item->id)
                    ->update(['user_id' => $cart->user_id]);
            } elseif ($admin) {
                \Illuminate\Support\Facades\DB::table('cart_items')
                    ->where('id', $item->id)
                    ->update(['user_id' => $admin->id]);
            }
        }

        Schema::table('menus', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('cart_items', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });

        Schema::table('menus', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
