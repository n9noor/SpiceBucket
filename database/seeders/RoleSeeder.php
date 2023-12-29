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
            'design_property' => '{"fixed-header":"1","fixed-sidebar":"1","fixed-footer":"1","switch-header-cs-class":"bg-midnight-bloom header-text-light","switch-sidebar-cs-class":"bg-midnight-bloom sidebar-text-light","page-switch-theme-class":"body-tabs-shadow","switch-theme-class":"app-theme-white"}',
            'property' => '{"vendors":{"add":"1","viewlist":"1","viewpage":"1","active":"1","approve":"1","delete":"1","verifygst":"1"},"products":{"add":"1","viewlist":"1","viewpage":"1","edit":"1","active":"1","approve":"1","delete":"1"}}'
        ]);
        DB::table('roles')->insert([
            'rolename' => 'QAC Department',
            'parent' => 1,
            'description' => 'This department will be responsible for handling all the work related to approval for vendors and products',
            'design_property' => '{"fixed-header":"1","fixed-sidebar":"1","fixed-footer":"1","switch-header-cs-class":"bg-midnight-bloom header-text-light","switch-sidebar-cs-class":"bg-midnight-bloom sidebar-text-light","page-switch-theme-class":"body-tabs-shadow","switch-theme-class":"app-theme-white"}',
            'property' => '{"vendors":{"add":"1","viewlist":"1","viewpage":"1","active":"1","approve":"1","delete":"0","verifygst":"1"},"products":{"add":"1","viewlist":"1","viewpage":"1","edit":"1","active":"1","approve":"1","delete":"0"}}'
        ]);
        DB::table('roles')->insert([
            'rolename' => 'HR Department',
            'parent' => 1,
            'description' => 'This department will be responsible for handling all the work related to HR',
            'design_property' => '{"fixed-header":"1","fixed-sidebar":"1","fixed-footer":"1","switch-header-cs-class":"bg-midnight-bloom header-text-light","switch-sidebar-cs-class":"bg-midnight-bloom sidebar-text-light","page-switch-theme-class":"body-tabs-shadow","switch-theme-class":"app-theme-white"}',
            'property' => '{"vendors":{"add":"0","viewlist":"0","viewpage":"0","active":"0","approve":"0","delete":"0","verifygst":"0"},"products":{"add":"0","viewlist":"0","viewpage":"0","edit":"0","active":"0","approve":"0","delete":"0"}}'
        ]);
        DB::table('roles')->insert([
            'rolename' => 'Accout Department',
            'parent' => 1,
            'description' => 'This department will be responsible for handling all the work related to accounts',
            'design_property' => '{"fixed-header":"1","fixed-sidebar":"1","fixed-footer":"1","switch-header-cs-class":"bg-midnight-bloom header-text-light","switch-sidebar-cs-class":"bg-midnight-bloom sidebar-text-light","page-switch-theme-class":"body-tabs-shadow","switch-theme-class":"app-theme-white"}',
            'property' => '{"vendors":{"add":"0","viewlist":"0","viewpage":"0","active":"0","approve":"0","delete":"0","verifygst":"0"},"products":{"add":"0","viewlist":"0","viewpage":"0","edit":"0","active":"0","approve":"0","delete":"0"}}'
        ]);
        DB::table('roles')->insert([
            'rolename' => 'Inventory management',
            'parent' => 1,
            'description' => 'This department will be responsible for handling all the work related to stock of the products',
            'design_property' => '{"fixed-header":"1","fixed-sidebar":"1","fixed-footer":"1","switch-header-cs-class":"bg-midnight-bloom header-text-light","switch-sidebar-cs-class":"bg-midnight-bloom sidebar-text-light","page-switch-theme-class":"body-tabs-shadow","switch-theme-class":"app-theme-white"}',
            'property' => '{"vendors":{"add":"0","viewlist":"0","viewpage":"0","active":"0","approve":"0","delete":"0","verifygst":"0"},"products":{"add":"0","viewlist":"0","viewpage":"0","edit":"0","active":"0","approve":"0","delete":"0"}}'
        ]);
        DB::table('roles')->insert([
            'rolename' => 'Front Desk department',
            'parent' => 1,
            'description' => 'This department will be responsible for handling all the work related to front desk',
            'design_property' => '{"fixed-header":"1","fixed-sidebar":"1","fixed-footer":"1","switch-header-cs-class":"bg-midnight-bloom header-text-light","switch-sidebar-cs-class":"bg-midnight-bloom sidebar-text-light","page-switch-theme-class":"body-tabs-shadow","switch-theme-class":"app-theme-white"}',
            'property' => '{"vendors":{"add":"0","viewlist":"0","viewpage":"0","active":"0","approve":"0","delete":"0","verifygst":"0"},"products":{"add":"0","viewlist":"0","viewpage":"0","edit":"0","active":"0","approve":"0","delete":"0"}}'
        ]);
        DB::table('roles')->insert([
            'rolename' => 'Customer Support',
            'parent' => 1,
            'description' => 'This department will be responsible for handling all the work related to supporting the customer',
            'design_property' => '{"fixed-header":"1","fixed-sidebar":"1","fixed-footer":"1","switch-header-cs-class":"bg-midnight-bloom header-text-light","switch-sidebar-cs-class":"bg-midnight-bloom sidebar-text-light","page-switch-theme-class":"body-tabs-shadow","switch-theme-class":"app-theme-white"}',
            'property' => '{"vendors":{"add":"0","viewlist":"0","viewpage":"0","active":"0","approve":"0","delete":"0","verifygst":"0"},"products":{"add":"0","viewlist":"0","viewpage":"0","edit":"0","active":"0","approve":"0","delete":"0"}}'
        ]);
    }
}
