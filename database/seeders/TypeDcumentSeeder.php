<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TypeDocument;

class TypeDcumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ 'name' => 'CI'],
            [ 'name' => 'RUC'],
            [ 'name' => 'RIF'],
        ];
        foreach ($data as $key => $typeDocument) {
            TypeDocument::create($typeDocument);
        }
    }
}
