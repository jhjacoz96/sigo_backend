<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Employee;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_one = User::create([
            'email' => 'admin@gmail.com',
            'password' => bcrypt('Admin_96'),
        ]);
        
        $client_one = Employee::create(["name"=> 'Albani Juarez', "phone"=> '04948393', "email"=> "admin@gmail.com",
            "user_id"=>  $user_one->id,
            "document"=> '295484022',
            "comment"=> '',
            "type_document_id"=> 1,
            "status"=> 'A'
        ]);

        $user_two = User::create([
            'email' => 'admin1@gmail.com',
            'password' => bcrypt('Admin_96'),
        ]);
        
        $client_two = Employee::create(["name"=> 'Jhon Contreras', "phone"=> '04948393', "email"=> "admin1@gmail.com",
            "user_id"=>  $user_two->id,
            "document"=> '26378059',
            "comment"=> '',
            "type_document_id"=> 1,
            "status"=> 'A'
        ]);

    }
}
