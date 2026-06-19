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
        Schema::table('contacts', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
        });

        // Map existing contacts to user_id based on name to preserve dummy data
        $contacts = \Illuminate\Support\Facades\DB::table('contacts')->get();

        foreach ($contacts as $contact) {
            $user = \Illuminate\Support\Facades\DB::table('users')->where('name', $contact->name)->first();
            
            if ($user) {
                \Illuminate\Support\Facades\DB::table('contacts')
                    ->where('id', $contact->id)
                    ->update(['user_id' => $user->id]);
            }
        }

        Schema::table('contacts', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
