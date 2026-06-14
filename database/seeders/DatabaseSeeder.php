<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call() berfungsi untuk mengeksekusi file class seeder lain.
        // Dengan mendaftarkan class di bawah ini, Anda hanya perlu menjalankan 1 perintah terminal: 
        // 'php artisan db:seed'
        // untuk mengeksekusi semua seeder yang terdaftar secara bersamaan.
        $this->call([
            PenggunaSeeder::class,
            KursusSeeder::class,
        ]);
    }
}
