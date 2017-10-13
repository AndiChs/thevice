<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->increments('id');
            $table->string('player_name');
            $table->string('complainant_name');
            $table->string('admin_name');
            $table->tinyInteger('type');
            $table->tinyInteger('status');
            $table->string('proofs');
            $table->string('body');
            $table->tinyInteger('action');
            $table->integer('action_amount');
            $table->tinyInteger('action_reason');
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
        Schema::dropIfExists('complaints');
    }
}
