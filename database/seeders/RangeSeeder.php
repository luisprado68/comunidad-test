<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ranges');
 
        $ranges = [
            ['name' => 'Bronce', 'hours_for_day' => 1,'hours_for_week' => 3],
            ['name' => 'Plata', 'hours_for_day' => 1,'hours_for_week' => 6],
            ['name' => 'Oro', 'hours_for_day' => 2,'hours_for_week' => 12],
            ['name' => 'Platino', 'hours_for_day' => 3,'hours_for_week' => 18],
        ];
 
        DB::table('ranges')->insert($ranges);
    }
}