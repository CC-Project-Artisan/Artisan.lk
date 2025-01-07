<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderCourierDetails;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $users = User::all();
        $products = Product::all();
        $statuses = ['pending', 'processing', 'shipped', 'delivered'];

        foreach(range(1, 10) as $index) {
            $user = $users->random();
            $order = Order::create([
                'user_id' => $user->id,
                'email' => $user->email,
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'address' => $faker->address,
                'city' => $faker->city,
                'phone' => $faker->phoneNumber,
                'total' => 0,
                'stripe_payment_id' => $faker->uuid,
                'status' => 'paid',
                'order_status' => $faker->randomElement($statuses),
            ]);

            // Create 1-3 order items
            $total = 0;
            foreach(range(1, rand(1, 3)) as $item) {
                $product = $products->random();
                $quantity = $faker->numberBetween(1, 5);
                $price = $product->productPrice;
                
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $price
                ]);

                $total += ($price * $quantity);
            }

            // Update order total
            $order->update(['total' => $total]);

            // Add courier details if shipped
            if($order->order_status === 'shipped') {
                OrderCourierDetails::create([
                    'order_id' => $order->id,
                    'courier_name' => $faker->company,
                    'courier_contact_number' => $faker->phoneNumber,
                    'tracking_number' => $faker->numerify('TRACK-####-####'),
                    'delivery_date' => $faker->dateTimeBetween('now', '+2 weeks'),
                ]);
            }
        }
    }
}