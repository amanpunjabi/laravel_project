<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_superadmin = new Role();
        $role_superadmin->name = "superadmin";
        $role_superadmin->description = "A superadmin";
        $role_superadmin->save();

        $role_admin = new Role();
        $role_admin->name = "admin";
        $role_admin->description = "An admin";
        $role_admin->save();


        $role_inventory = new Role();
        $role_inventory->name = "inventory_manager";
        $role_inventory->description = "An inventory manager";
        $role_inventory->save();


        $role_order = new Role();
        $role_order->name = "order_manager";
        $role_order->description = "An order Manager";
        $role_order->save();

        $role_customer = new Role();
        $role_customer->name = "customer";
        $role_customer->description = "A Customer";
        $role_customer->save();
    }
}
