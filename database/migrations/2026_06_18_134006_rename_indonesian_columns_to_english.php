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
        Schema::rename('reservasis', 'reservations');

        DB::statement('ALTER TABLE reservations CHANGE nama name VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE reservations CHANGE tanggal date DATE NOT NULL');
        DB::statement('ALTER TABLE reservations CHANGE waktu time TIME NOT NULL');
        DB::statement('ALTER TABLE reservations CHANGE jumlah_orang guest_count INT NOT NULL');
        DB::statement('ALTER TABLE reservations CHANGE total_bayar total_price INT NOT NULL');

        DB::statement('ALTER TABLE menus CHANGE nama_menu name VARCHAR(255) NOT NULL');
        DB::statement("ALTER TABLE menus CHANGE kategori category VARCHAR(255) NOT NULL DEFAULT 'makanan'");
        DB::statement('ALTER TABLE menus CHANGE deskripsi description TEXT NULL');
        DB::statement('ALTER TABLE menus CHANGE harga price INT NOT NULL');
        DB::statement('ALTER TABLE menus CHANGE harga_hot price_hot INT NULL');
        DB::statement('ALTER TABLE menus CHANGE harga_cold price_cold INT NULL');
        DB::statement('ALTER TABLE menus CHANGE gambar image VARCHAR(255) NULL');

        DB::statement('ALTER TABLE orders CHANGE nama name VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE orders CHANGE menu items VARCHAR(255) NOT NULL');

        DB::statement('ALTER TABLE cart_items CHANGE tipe type VARCHAR(255) NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE cart_items CHANGE type tipe VARCHAR(255) NULL');

        DB::statement('ALTER TABLE orders CHANGE items menu VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE orders CHANGE name nama VARCHAR(255) NOT NULL');

        DB::statement('ALTER TABLE menus CHANGE image gambar VARCHAR(255) NULL');
        DB::statement('ALTER TABLE menus CHANGE price_cold harga_cold INT NULL');
        DB::statement('ALTER TABLE menus CHANGE price_hot harga_hot INT NULL');
        DB::statement('ALTER TABLE menus CHANGE price harga INT NOT NULL');
        DB::statement('ALTER TABLE menus CHANGE description deskripsi TEXT NULL');
        DB::statement("ALTER TABLE menus CHANGE category kategori VARCHAR(255) NOT NULL DEFAULT 'makanan'");
        DB::statement('ALTER TABLE menus CHANGE name nama_menu VARCHAR(255) NOT NULL');

        DB::statement('ALTER TABLE reservations CHANGE total_price total_bayar INT NOT NULL');
        DB::statement('ALTER TABLE reservations CHANGE guest_count jumlah_orang INT NOT NULL');
        DB::statement('ALTER TABLE reservations CHANGE time waktu TIME NOT NULL');
        DB::statement('ALTER TABLE reservations CHANGE date tanggal DATE NOT NULL');
        DB::statement('ALTER TABLE reservations CHANGE name nama VARCHAR(255) NOT NULL');

        Schema::rename('reservations', 'reservasis');
    }
};
