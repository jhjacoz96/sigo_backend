<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Client;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'email' => 'admin1@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $client = User::Client([
            "name"=> 'Albani Juarez',
            "phone"=> '04948393',
            "email"=> 'admin1@gmail.com',
            "user_id"=>  $user->id,
            "document"=> '295484022',
            "comment"=> null,
            "type_document_id"=> 1,
            "status"=> 'A'
        ]);
    }
}
