<?php

namespace Database\Seeders;

use App\Enum\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Role::query()->insert([
            [
                'id' => 1,
                'role_name' => 'courier',
                'user_id' => 1,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'id' => 2,
                'role_name' => 'setClient',
                'user_id' => 2,
                'created_at'=>now(),
                'updated_at'=>now(),
            ]
        ]);
    }
}
