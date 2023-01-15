<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'emailid' => 'info@spicebucket.net',
            'password' => Hash::make('12345'),
            'role_id' => 1,
            'firstname' => 'Spice Bucket',
            'lastname' => 'Administrator',
            'design_property' => '{"fixed-header":"1","fixed-sidebar":"1","fixed-footer":"1","switch-header-cs-class":"bg-midnight-bloom header-text-light","switch-sidebar-cs-class":"bg-midnight-bloom sidebar-text-light","page-switch-theme-class":"body-tabs-shadow","switch-theme-class":"app-theme-white"}'
        ]);
    }
}
