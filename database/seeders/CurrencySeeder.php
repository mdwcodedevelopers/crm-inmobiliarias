<?php

use Illuminate\Database\Seeder;
use App\Models\Currency;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //EUR USD
        $currency = [
            array(
                'currency' => 'USD',
            ),
            array(
                'currency' => 'EUR',
            ),                
        ];

        foreach ($currency as $key => $value) {
            Currency::create($value);
        }
    }
}
