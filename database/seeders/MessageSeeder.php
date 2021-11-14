<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MessageSeeder extends Seeder
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
                'message' => 'This is sample message.',
                'send_by' => 0
            ],
            [
                'user_id' => 1,
                'mentor_id' => 2,
                'message' => 'This is sample message.',
                'send_by' => 0
            ],
            [
                'user_id' => 1,
                'mentor_id' => 2,
                'message' => 'This is sample message.',
                'send_by' => 1
            ],
        ];
        DB::table('messages')->insert($param);
    }
}
