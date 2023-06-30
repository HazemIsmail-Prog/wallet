<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Country::create([
            'name' => 'Kuwait',
            'user_id' => 1,
            'currency' => 'kwd',
            'decimal_points' => 3,
        ]);
        Country::create([
            'name' => 'Egypt',
            'user_id' => 1,
            'currency' => 'egp',
            'decimal_points' => 2,
        ]);

        session()->put('current_country', Country::find(1));

    }
}
