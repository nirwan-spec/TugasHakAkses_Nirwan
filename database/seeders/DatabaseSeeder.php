<?php

namespace Database\Seeders;

use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@venue.test'],
            ['name' => 'Admin Venue', 'password' => Hash::make('password123'), 'role' => 'admin']
        );

        User::updateOrCreate(
            ['email' => 'staff@venue.test'],
            ['name' => 'Staff Venue', 'password' => Hash::make('password123'), 'role' => 'staff']
        );

        User::updateOrCreate(
            ['email' => 'member@venue.test'],
            ['name' => 'Member Biasa', 'password' => Hash::make('password123'), 'role' => 'member']
        );

        $contoh = [
            ['nama' => 'Budi Santoso', 'email' => 'budi@mail.test', 'no_hp' => '081111111111', 'level_member' => 'gold',  'status' => 'aktif'],
            ['nama' => 'Citra Dewi',   'email' => 'citra@mail.test', 'no_hp' => '082222222222', 'level_member' => 'vip',   'status' => 'aktif'],
            ['nama' => 'Dimas Pratama','email' => 'dimas@mail.test', 'no_hp' => '083333333333', 'level_member' => 'basic', 'status' => 'nonaktif'],
        ];

        foreach ($contoh as $data) {
            Pelanggan::firstOrCreate(
                ['nama' => $data['nama']],
                $data + ['tanggal_bergabung' => now()->toDateString()]
            );
        }
    }
}