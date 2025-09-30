<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $obj = new Admin;
        $obj->name = "Siyam Khan";
        $obj->email = "admin@gmail.com";
        $obj->photo = "admin_1717493029.png";
        $obj->password = Hash::make('2107120');
        $obj->token = "";
        $obj->save();
    }
}
