<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMentorMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mentor_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('send_mentor_id')
                ->constrained('mentors')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('recieve_mentor_id')
                ->constrained('mentors')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->text('message');
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
        Schema::dropIfExists('mentor_messages');
    }
}
