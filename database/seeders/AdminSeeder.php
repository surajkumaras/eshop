<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Address;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = new User;
        $admin->name = 'Admin';
        $admin->email = 'admin@gmail.com';
        $admin->gender = 'male';
        $admin->role = '1';
        $admin->password = Hash::make('admin123');

        $address = new Address;
        $address->adress = '#1486,Sector 45';
        $address->city = 'Chandigarh';
        $address->pin_code = 160047;
        
        $admin->save();
        $admin->address()->save($address);
    }
}
