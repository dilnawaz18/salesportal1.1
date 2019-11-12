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
        factory(App\Location::class,30)->create();
        //factory(App\Location::class,30)->create();

     
    }
}
