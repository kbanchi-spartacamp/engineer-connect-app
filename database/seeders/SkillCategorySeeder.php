<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            ['name' => 'PHP'],
            ['name' => 'Laravel'],
            ['name' => 'Python'],
            ['name' => 'Ruby'],
            ['name' => 'Swift'],
            ['name' => 'Java'],
            ['name' => 'Spring'],
            ['name' => 'Go'],
            ['name' => 'React'],
            ['name' => 'HTML/CSS'],
            ['name' => 'AWS'],
            ['name' => 'JavaScript'],
        ];
        DB::table('skill_categories')->insert($param);
    }
}
