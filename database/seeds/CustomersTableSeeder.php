<?php

use Illuminate\Database\Seeder;
use App\Customer;
class CustomersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        Customer::truncate();

        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 50; $i++) {
            Customer::create([
                'name' => $faker->name,
                'img_url' => $faker->imageUrl($width = 200, $height = 200),
                'web_url' =>$faker->url,
                'location_id' =>$faker->numberBetween($min = 1, $max = 5),
                'industry_id' =>$faker->numberBetween($min = 1, $max = 5),
                'is_updated' => $faker->boolean($chanceOfGettingTrue = 20 )
            ]);
        }
    }
}
