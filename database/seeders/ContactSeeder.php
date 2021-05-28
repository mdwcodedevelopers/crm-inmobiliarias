<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Contact;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contact::Create([
            'name' => 'Contacto de prueba',
            'email' => 'prueba@mail.com',
            'phone_1' => '11223345',
            'phone_2' => '12223345',
            'direction' => 'Buenos aires',
            'province' => 'provincia de buenos aires',

        ]);
    }
} 