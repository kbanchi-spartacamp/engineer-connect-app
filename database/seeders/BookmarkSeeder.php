<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookmarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            ['user_id' => 1, 'mentor_id' => 1],
            ['user_id' => 1, 'mentor_id' => 2],
            ['user_id' => 1, 'mentor_id' => 3],
        ];
        DB::table('bookmarks')->insert($param);
    }
}
