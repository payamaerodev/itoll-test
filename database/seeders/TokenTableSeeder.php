<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TokenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('personal_access_tokens')->insert([
            [
                'id' => 1,
                'tokenable_type' => 'App\Models\User',
                'tokenable_id' => 1,
                'name' => 'courier',
                'token' => '0b97fc74d33bd5546e4f51d039e58492b478aedaf6e3ef670161529761ad1ba0',
                'last_used_at' => '2023-07-20 22:57:42',
                'expires_at' => now()->addHours(),
                'created_at' => '2023-07-20 22:57:42',
                'updated_at' => '2023-07-20 22:57:42',
            ],

            [
                'id' => 2,
                'tokenable_type' => 'App\Models\User',
                'tokenable_id' => 2,
                'name' => 'setClient',
                'token' => '577e6efbb7c04b000cc2ebfb7539c13801221e608b280f192e513c92a044ed44',
                'last_used_at' => '2023-07-20 22:57:42',
                'expires_at' => now()->addHours(1),
                'created_at' => '2023-07-20 22:57:42',
                'updated_at' => '2023-07-20 22:57:42',
            ],
        ]);
    }
}
