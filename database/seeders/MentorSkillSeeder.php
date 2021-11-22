<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MentorSkillSeeder extends Seeder
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
                'skill_category_id' => 1,
                'experience_year' => 3
            ],
            [
                'mentor_id' => 1,
                'skill_category_id' => 2,
                'experience_year' => 3
            ],
            [
                'mentor_id' => 1,
                'skill_category_id' => 3,
                'experience_year' => 3
            ],
        ];
        DB::table('mentor_skills')->insert($param);
    }
}
