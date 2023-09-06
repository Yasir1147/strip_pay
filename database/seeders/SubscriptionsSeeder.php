<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plan;

class SubscriptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $subscriptions = [

            [
                'name' => 'Premium Plan',
                'slug' => 'premium-plan',
                'strip_plan' => 'price_1NmctOEY8x3kNn22YWxl4OqO',
                'price' => '50',
                'description' => 'Premium Plan',
                'duration' => 'Monthly',


            ],
            [
                'name' => 'Business Plan',
                'slug' => 'business-plan',
                'strip_plan' => 'price_1Nmcu7EY8x3kNn22LazJMLid',
                'price' => '500',
                'description' => 'Business Plan',
                'duration' => 'Yearly',

            ],
        ];
        foreach ($subscriptions as $sub) {
            Plan::create($sub);
        }
    }
}
