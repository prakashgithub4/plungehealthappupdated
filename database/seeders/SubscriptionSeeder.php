<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subscription;
use Illuminate\Support\Facades\DB;
class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans = [
            [
                "id"        => 1,
                "name"      => "Sopoline Hardy",
                "price"     => 636,
                "discount"  => "95.00",
                "popular"   => '0',
                "features"  => '0',
            ],
            [
                "id"        => 2,
                "name"      => "Monthly",
                "price"     => 2,
                "discount"  => '0',
                "popular"   => '0',
                "features"  => '0',
            ],
            [
                "id"        => 3,
                "name"      => "Yearly",
                "price"     => 35,
                "discount"  => "10.00",
                "popular"   => '0',
                "features"  => '0',
            ],
            [
                "id"        => 4,
                "name"      => "Premium",
                "price"     => 200,
                "discount"  => "2.00",
                "popular"   => '0',
                "features"  => '0',
            ],
            [
                "id"        => 5,
                "name"      => "test",
                "price"     => 30,
                "discount"  => "2.90",
                "popular"   => '0',
                "features"  => '0',
            ],
        ];
          DB::table('subscription')->insert($plans);
    }
}
