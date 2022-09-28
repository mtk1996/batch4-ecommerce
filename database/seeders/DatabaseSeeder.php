<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //color
        $colors  = ['red', 'green', 'blue', 'black'];
        foreach ($colors as $c) {
            Color::create([
                'slug' => uniqid() . $c,
                'name' => $c
            ]);
        }

        //brand
        $brand  = ['huawei', 'apple', 'xiaomi', 'samsung', 'zte'];
        foreach ($brand as $c) {
            Brand::create([
                'slug' => uniqid() . $c,
                'name' => $c
            ]);
        }

        //category

        Category::create([
            'slug' => Str::slug('computer'),
            'en_name' => "Computer",
            'mm_name' => 'ကွန်ပျူတာ',
            'image' => '631eeb618dbd6computer.jpeg'
        ]);
        Category::create([
            'slug' => Str::slug('smart-phone'),
            'en_name' => "Smart Phone",
            'mm_name' => 'ဖုန်း',
            'image' => '630f58a38a5df2.webp'
        ]);
        //user
        User::create([
            'name' => "Mg Mg",
            'email' => "mgmg@a.com",
            'password' => Hash::make('password'),
        ]);
        Admin::create([
            'name' => "Admin",
            'email' => "admin@a.com",
            'password' => Hash::make('password'),
        ]);
        //Suppplier
        Supplier::create([
            'name' => 'Supplier One',
            'phone' => "09",
            'image' => "user.png",
        ]);
    }
}
