<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contact::create([
            'name' => 'Contact1',
            'country_id' => 1,
        ]);
        Contact::create([
            'name' => 'Contact2',
            'country_id' => 1,
        ]);
    }
}
