<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Organization;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = Organization::create([
        	'name' => 'Zapateria 59',
            'currency' => 'CLP',
            'address' => 'Av las delicias',
            'city' => 'Santiago De Chile',
            'country' => 'Chile',
            'phone' => '494829384',
            'document' => '444444444',
            'type_document_id' => 2
        ]);
    }
}
