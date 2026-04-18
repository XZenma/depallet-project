<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Stall;
use App\Models\StallAccount;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        StallAccount::factory(5)->create();

        $stalls = Stall::all();
        Menu::factory(20)->create([
            'stall_id' => $stalls->random()->stall_id,
        ]);

        Customer::factory(10)->create();

        $customers = Customer::all();
        Order::factory(15)->create([
            'customer_id' => $customers->random()->customer_id,
        ]);

        $orders = Order::all();
        $menus = Menu::all();
        OrderItem::factory(30)->create([
            'order_id' => $orders->random()->order_id,
            'menu_id'  => $menus->random()->menu_id,
        ]);
    }
}
