<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMentorSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mentor_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mentor_id')
                ->constrained('mentors')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->date('day')->nullable();
            $table->tinyInteger('day_of_week')->nullable();
            $table->time('start_time');
            $table->tinyInteger('regular_type');
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
        Schema::dropIfExists('mentor_schedules');
    }
}
