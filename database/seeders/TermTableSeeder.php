<?php

namespace Database\Seeders;
use DB;
use Illuminate\Database\Seeder;

class TermTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('terms')->insert(
            ['term' => 'one'],
            ['term' => 'two']
           
        );
    }
}
