<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123')
        ]);

        \App\Models\Category::create([
            'id'    => 1,
            'name' => 'Arabika',
        ]);

        \App\Models\Category::create([
            'id' => 2,
            'name' => 'Americano',
        ]);

        \App\Models\Product::create([
            'category_id' => 1,
            'name' => 'Kopi Luwak Sumatra',
            'quantity' => 10,
            'price' => '10000',
            'description' => 'desc',
            'status' => 1,
            'raw' => 0,
        ]);

        \App\Models\Product::create([
            'category_id' => 1,
            'name' => 'Kopi Jawa',
            'quantity' => 20,
            'price' => '20000',
            'description' => 'desc',
            'status' => 1,
            'raw' => 0,
        ]);

        \App\Models\Product::create([
            'category_id' => 2,
            'name' => 'Bibit Kopi Luwak Sumatra',
            'quantity' => 10,
            'price' => '10000',
            'description' => 'desc',
            'status' => 1,
            'raw' => 1,
        ]);

        \App\Models\Product::create([
            'category_id' => 2,
            'name' => 'Bibit Kopi Hitam',
            'quantity' => 20,
            'price' => '20000',
            'description' => 'desc',
            'status' => 1,
            'raw' => 1,
        ]);

        \App\Models\Setting::create([
            'name' => 'Cofee Center',
            'service_time' => '09.00 - 15.00',
            'address' => 'Jl.Urip Sumoharjo',
            'description' => 'Penjual Kopi No 1 di Lampung dan sudah menjual hampir ke seluruh Indonesia',
            'keywords' => 'Bersatu Kita Teguh, Bercerai Kita Runtuh',
            'instagram' => 'https://github.com/GilbertDay',
            'facebook' => 'https://github.com/GilbertDay',
            'email' => 'gilbert.christyano@si.ukdw.ac.id',
            'instagram' => 'https://github.com/GilbertDay',
            'whatsapp' => '08214763055',
            'phone' => '08214763055',
        ]);
    }
}
