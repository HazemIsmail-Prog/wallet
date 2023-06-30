<?php

namespace Database\Seeders;

use App\Models\Wallet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Wallet::create([
            'name' => 'Wallet',
            'country_id' => 1,
            'init_amount' => 1,
            'order' => 1,
            'is_visible' => 1,
            'color' => '#9CA3AF',
        ]);
        Wallet::create([
            'name' => 'Hazem - KFH',
            'country_id' => 1,
            'init_amount' => 1,
            'order' => 1,
            'is_visible' => 1,
            'color' => '#9CA3AF',
        ]);
        Wallet::create([
            'name' => 'Hazem - Al Waha',
            'country_id' => 1,
            'init_amount' => 1,
            'order' => 1,
            'is_visible' => 1,
            'color' => '#9CA3AF',
        ]);
        Wallet::create([
            'name' => 'Norhan - KFH',
            'country_id' => 1,
            'init_amount' => 1,
            'order' => 1,
            'is_visible' => 1,
            'color' => '#9CA3AF',
        ]);
    }
}
