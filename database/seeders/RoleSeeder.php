<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'rolename' => 'Administrator',
            'description' => 'This role will hold the permission for administrator',
            'design_property' => '{"fixed-header":"1","fixed-sidebar":"1","fixed-footer":"1","switch-header-cs-class":"bg-midnight-bloom header-text-light","switch-sidebar-cs-class":"bg-midnight-bloom sidebar-text-light","page-switch-theme-class":"body-tabs-shadow","switch-theme-class":"app-theme-white"}'
        ]);
        DB::table('roles')->insert([
            'rolename' => 'Members',
            'parent' => 1,
            'description' => 'This role will hold the permission for members',
            'design_property' => '{"fixed-header":"1","fixed-sidebar":"1","fixed-footer":"1","switch-header-cs-class":"bg-midnight-bloom header-text-light","switch-sidebar-cs-class":"bg-midnight-bloom sidebar-text-light","page-switch-theme-class":"body-tabs-shadow","switch-theme-class":"app-theme-white"}'
        ]);
    }
}
