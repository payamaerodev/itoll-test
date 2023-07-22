<?php

namespace Database\Seeders;

use App\Enum\Status;
use App\Models\ServiceRequest;
use Exception;
use Illuminate\Database\Seeder;

class ServiceRequestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {

        for ($i = 1; $i < 3; $i++) {
            $input=[
            'id'=>random_int(1, 2000000000),
            'status'=>Status::CREATED,
            'user_id'=>random_int(1, 2),
            'destination_longitude'=>random_int(1, 180),
            'destination_latitude'=>random_int(1, 90),
            'sender_name'=>fake()->name,
            'receiver_name'=>fake()->name,
            'receiver_number'=>'09366363692',
            'sender_number'=>'09125455654',
            'source_longitude'=>random_int(1, 180),
            'source_latitude'=>random_int(1, 90),
            'source_address'=>fake()->address,
            'destination_address'=>fake()->address,
            'webhook_url'=>fake()->url,
            'created_at'=>now(),
            'updated_at'=>now()
            ];
            ServiceRequest::query()->insert($input);
        }
    }
}
