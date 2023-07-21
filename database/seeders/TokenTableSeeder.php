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
                'token' => '86174d538440c35c28341c58eb44d4e2ee965acbedad7118e6f4ec0e7c92ba8e',
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
                'token' => 'a053cb3e25eb52993be822a2d462a558b9c55c52291a6d6a27f49ea3ebde7933',
                'last_used_at' => '2023-07-20 22:57:42',
                'expires_at' => now()->addHours(1),
                'created_at' => '2023-07-20 22:57:42',
                'updated_at' => '2023-07-20 22:57:42',
            ],
        ]);
    }
}
