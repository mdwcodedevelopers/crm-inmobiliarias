<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Currency;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies = [
            array('name' => 'USD'),
            array('name' => 'EUR'),
            array('name' => 'ARS'),
        ];

        foreach ($currencies as $key => $value) {
            Currency::create($value);
        }
    }
}
