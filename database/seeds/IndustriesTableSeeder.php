<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class IndustriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('industries')->delete();
        DB::table('industries')->truncate();
        DB::table('industries')->insert([


            [
                'name' => 'Aviation',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'name' => 'Education',
                'created_at'=>now(),
                'updated_at'=>now()
            ],[
                'name' => 'Government Administration',
                'created_at'=>now(),
                'updated_at'=>now()
            ],[
                'name' => 'Healthcare',
                'created_at'=>now(),
                'updated_at'=>now()
            ],[
                'name' => 'Hospitality',
                'created_at'=>now(),
                'updated_at'=>now() 
            ],[
                'name' => 'Logistics',
                'created_at'=>now(),
                'updated_at'=>now()
            ],[
                    'name' => 'Manpower',
                    'created_at'=>now(),
                'updated_at'=>now()
            ],[
                'name' => 'Mechanical / Industrial',
                'created_at'=>now(),
                'updated_at'=>now()
            ],[
                'name' => 'Power & Energy',
                'created_at'=>now(),
                'updated_at'=>now()
            ],[
                
                'name' => 'Power & Energy',
                'created_at'=>now(),
                'updated_at'=>now()
            ]
        ]);
    }
}
