<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Address;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User;
        $user->name = 'Suraj Kumar';
        $user->email = 'user@gmail.com';
        $user->phone = 8360666189;
        $user->gender = 'male';
        $user->role = '0';
        $user->password = Hash::make('user123');

        $address = new Address;
        $address->adress = '#1486,Sector 45';
        $address->city = 'Chandigarh';
        $address->pin_code = 160047;
        
        $user->save();
        $user->address()->save($address);
    }
}
