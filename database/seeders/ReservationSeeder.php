<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Nette\Utils\DateTime;

class ReservationSeeder extends Seeder
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
                'day' => new DateTime(),
                'start_time' => new DateTime(),

            ],
        ];
        DB::table('reservations')->insert($param);
    }
}
