<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->insert([
         [   'id' => 1,
            'name' => 'payam',
            'role_id' => '1',
            'email' => 'p@gmail.com',
            'email_verified_at' => '2023-07-21 02:56:22',
            'password' => '123456',
            'remember_token' => '',
            'created_at' => '2023-07-21 02:56:22',
            'updated_at' => '2023-07-21 02:56:22',
             ],
            [   'id' => 2,
                'name' => 'pooria',
                'role_id' => '2',
                'email' => 'poo@gmail.com',
                'email_verified_at' => '2023-07-21 02:56:22',
                'password' => '123456',
                'remember_token' => '',
                'created_at' => '2023-07-21 02:56:22',
                'updated_at' => '2023-07-21 02:56:22',]
        ]);


    }
}
