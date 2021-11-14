<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            [
                'user_id' => 1,
                'mentor_id' => 1,
                'star' => 5
            ],
            [
                'user_id' => 1,
                'mentor_id' => 2,
                'star' => 3
            ],
            [
                'user_id' => 1,
                'mentor_id' => 3,
                'star' => 4
            ],
        ];
        DB::table('reviews')->insert($param);
    }
}
