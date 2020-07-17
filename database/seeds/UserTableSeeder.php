<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

	$role_superadmin = Role::where('name','superadmin')->first();


	$role_admin = Role::where('name','admin')->first();

	$role_inventory = Role::where('name','inventory_manager')->first();

	$role_order = Role::where('name','order_manager')->first();

	$role_customer = Role::where('name','customer')->first();

        $superadmin = new User();
        $superadmin->firstname = "super admin";
        $superadmin->email = "superadmin@gmail.com";
        $superadmin->password = Hash::make('amanaman');
        $superadmin->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $superadmin->save();
        $superadmin->roles()->attach($role_superadmin);
    
        // $admin = new User();
        // $admin->name = "admin";
        // $admin->email = "admin@gmail.com";
        // $admin->password = bcrypt('amanaman');
        // $admin->created_at = Carbon::now()->format('Y-m-d H:i:s');
        // $admin->save();
        // $admin->roles()->attach($role_admin);


        // $inventory_manager = new User();
        // $inventory_manager->name = "inventory";
        // $inventory_manager->email = "inventory@gmail.com";
        // $inventory_manager->password = bcrypt('amanaman');
        // $inventory_manager->created_at = Carbon::now()->format('Y-m-d H:i:s');
        // $inventory_manager->save();
        // $inventory_manager->roles()->attach($role_inventory);


        // $order_manager = new User();
        // $order_manager->name = "order";
        // $order_manager->email = "order@gmail.com";
        // $order_manager->password = bcrypt('amanaman');
        // $order_manager->created_at = Carbon::now()->format('Y-m-d H:i:s');
        // $order_manager->save();
        // $order_manager->roles()->attach($role_order);


        // $customer = new User();
        // $customer->name = "customer";
        // $customer->email = "customer@gmail.com";
        // $customer->password = bcrypt('amanaman');
        // $customer->created_at = Carbon::now()->format('Y-m-d H:i:s');
        // $customer->save();
        // $customer->roles()->attach($role_customer);
    }
}
