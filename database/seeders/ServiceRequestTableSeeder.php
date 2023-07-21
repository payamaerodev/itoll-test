<?php

namespace Database\Seeders;

use App\Models\ServiceRequest;
use Exception;
use Faker\Guesser\Name;
use Faker\Provider\fa_IR\Address;
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
        $data = [
            [
                random_int(1, 9999999), array_rand(['ACCEPTED', 'CREATED']),
                random_int(1, 2), random_int(1, 180), random_int(1, 90), Name::class,
                Name::class, '09366363692', '09125455654', random_int(1, 180),
                random_int(1, 90), Address::class, Address::class, now(), now(),
            ],
        ];
        for ($i = 1; $i < 10; $i++) {
            ServiceRequest::query()->create($data[$i]);
        }
    }
}
