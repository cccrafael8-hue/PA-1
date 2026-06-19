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
        // Add 'customer' to enum
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'user', 'customer') DEFAULT 'customer'");
        
        // Update existing 'user' roles to 'customer'
        \Illuminate\Support\Facades\DB::statement("UPDATE users SET role = 'customer' WHERE role = 'user'");
        
        // Remove 'user' from enum
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'customer') DEFAULT 'customer'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Add 'user' back to enum
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'customer', 'user') DEFAULT 'user'");
        
        // Revert existing 'customer' roles to 'user'
        \Illuminate\Support\Facades\DB::statement("UPDATE users SET role = 'user' WHERE role = 'customer'");
        
        // Remove 'customer' from enum
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'user') DEFAULT 'user'");
    }
};
