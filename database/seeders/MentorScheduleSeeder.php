<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Type\Time;
use Nette\Utils\DateTime;

class MentorScheduleSeeder extends Seeder
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
                'mentor_id' => 1,
                'day' => null,
                'day_of_week' => 1,
                'start_time' => new DateTime(),
                'regular_type' => 0,
            ],
            [
                'mentor_id' => 1,
                'day' => new DateTime(),
                'day_of_week' => null,
                'start_time' => new DateTime(),
                'regular_type' => 1,
            ],
        ];
        DB::table('mentor_schedules')->insert($param);
    }
}
