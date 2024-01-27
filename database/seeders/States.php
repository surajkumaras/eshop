<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\State;
use Illuminate\Support\Facades\DB;

class States extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = [
            //**************** STATES ****************** */
            ['state' => 'Andhra Pradesh', 'state_code' => 'AP'],
            ['state' => 'Arunachal Pradesh', 'state_code' => 'ARP'],
            ['state' => 'Assam', 'state_code' => 'AS'],
            ['state' => 'Bihar', 'state_code' => 'BR'],
            ['state' => 'Chhattisgarh', 'state_code' => 'CG'],
            ['state' => 'Goa', 'state_code' => 'GA'],
            ['state' => 'Gujarat', 'state_code' => 'GJ'],
            ['state' => 'Haryana', 'state_code' => 'HR'],
            ['state' => 'Himachal Pradesh', 'state_code' => 'HP'],
            ['state' => 'Jharkhand', 'state_code' => 'JH'],
            ['state' => 'Karnataka', 'state_code' => 'KT'],
            ['state' => 'Kerala', 'state_code' => 'KL'],
            ['state' => 'Madhya Pradesh', 'state_code' => 'MP'],
            ['state' => 'Maharashtra', 'state_code' => 'MH'],
            ['state' => 'Manipur', 'state_code' => 'MN'],
            ['state' => 'Meghalaya', 'state_code' => 'MG'],
            ['state' => 'Mizoram', 'state_code' => 'MZ'],
            ['state' => 'Nagaland', 'state_code' => 'NG'],
            ['state' => 'Odisha', 'state_code' => 'OD'],
            ['state' => 'Punjab', 'state_code' => 'PB'],
            ['state' => 'Rajasthan', 'state_code' => 'RJ'],
            ['state' => 'Sikkim', 'state_code' => 'SM'],
            ['state' => 'Tamil Nadu', 'state_code' => 'TN'],
            ['state' => 'Telangana', 'state_code' => 'TG'],
            ['state' => 'Tripura', 'state_code' => 'TP'],
            ['state' => 'Uttar Pradesh', 'state_code' => 'UP'],
            ['state' => 'Uttarakhand', 'state_code' => 'UK'],
            ['state' => 'West Bengal', 'state_code' => 'WB'],

            /************************** UT ***********************/
            ['state' => 'Andaman and Nicobar Islands', 'state_code' => 'AN'],
            ['state' => 'Chandigarh', 'state_code' => 'CH'],
            ['state' => 'Dadra & Nagar Haveli and Daman & Diu', 'state_code' => 'DD'],
            ['state' => 'Delhi', 'state_code' => 'DL'],
            ['state' => 'Jammu and Kashmir', 'state_code' => 'JK'],
            ['state' => 'Lakshadweep', 'state_code' => 'LD'],
            ['state' => 'Puducherry', 'state_code' => 'PC'],
            ['state' => 'Ladakh', 'state_code' => 'LD'],
            
        ];

        foreach ($states as $state) 
        {
            DB::table('states')->insert($state);
        }
    }
}
