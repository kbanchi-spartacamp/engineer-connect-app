<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class MentorMessageSeeder extends Seeder
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
                'send_mentor_id' => 1,
                'recieve_mentor_id' => 2,
                'message' => 'This is sample message.'
            ],
            [
                'send_mentor_id' => 2,
                'recieve_mentor_id' => 1,
                'message' => 'This is sample message.'
            ],
            [
                'send_mentor_id' => 2,
                'recieve_mentor_id' => 3,
                'message' => 'This is sample message.'
            ],
        ];
        DB::table('mentor_messages')->insert($param);
    }
}
