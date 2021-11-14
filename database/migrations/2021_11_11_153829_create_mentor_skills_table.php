<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMentorSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mentor_skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mentor_id')
                ->constrained('mentors')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('skill_category_id')
                ->constrained('skill_categories')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mentor_skills');
    }
}
