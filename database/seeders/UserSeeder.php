<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        $data = [
            'fullname' => 'Samit Koyom',
            'username' => 'iamsamit',
            'email' => 'samit@email.com',
            'password' => Hash::make('123456'),
            'tel' => '0878895487',
            'avatar' => 'https://via.placeholder.com/800x600.png/005429?text=udses',
            'role' => '1',
            'remember_token' => 'XBWyeaiest',
        ];
        User::create($data);

        // Testing Dummy User
        User::factory(99)->create();
    }
}
