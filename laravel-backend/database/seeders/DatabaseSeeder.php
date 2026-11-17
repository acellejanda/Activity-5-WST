<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Categories;
use App\Models\OrderProduct;
use App\Models\Orders;
use App\Models\Product1;
use App\Models\Reviews;
use App\Models\user1;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::disableQueryLog();

        $categories = Categories::factory(5)->create();
        $products = Product1::factory(2000)->recycle($categories)->create();
        $users = user1::factory(20)->create();

        $users->each(function (user1 $user): void {
            Address::factory(random_int(1, 2))->for($user)->create();
        });

        $orders = $users->flatMap(function (user1 $user) {
            return Orders::factory(random_int(0, 5))->for($user)->create();
        });

        $orders->each(function (Orders $order) use ($products): void {
            $products->random(random_int(1, 4))->each(function (Product1 $product) use ($order): void {
                OrderProduct::factory()->for($order, 'order')->for($product)->create();
            });
        });

        $products->each(function (Product1 $product) use ($users): void {
            $reviewCount = random_int(0, min(8, $users->count()));

            if ($reviewCount === 0) {
                return;
            }

            $users->random($reviewCount)->each(function (user1 $user) use ($product): void {
                Reviews::factory()->for($user)->for($product)->create();
            });
        });
    }
}
