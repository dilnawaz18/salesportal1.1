<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('locations')->truncate();
        DB::table('locations')->insert([


            [
                'name' => 'Abu Dhabi',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'name' => 'Dubai',
                'created_at'=>now(),
                'updated_at'=>now()
            ]
        ]);
    }
}
