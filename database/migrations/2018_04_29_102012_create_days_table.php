<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('days', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->boolean('is_available')->default(1);
            $table->unsignedInteger('lesson_id');
            $table->text('description');
            $table->string('task');
            $table->string('answer');
            $table->timestamps();

            $table->foreign('lesson_id')
                  ->references('id')->on('lessons')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('days', function(Blueprint $table) {
            $table->dropForeign('lesson_id');
        });
        Schema::dropIfExists('days');
    }
}
