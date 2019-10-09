<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('group_id');
            $table->string('name');
            $table->string('type');
            $table->integer('year');
            $table->integer('month');
            $table->string('day_1');
            $table->string('day_2');
            $table->string('day_3');
            $table->string('day_4');
            $table->string('day_5');
            $table->string('day_6');
            $table->string('day_7');
            $table->string('day_8');
            $table->string('day_9');
            $table->string('day_10');
            $table->string('day_11');
            $table->string('day_12');
            $table->string('day_13');
            $table->string('day_14');
            $table->string('day_15');
            $table->string('day_16');
            $table->string('day_17');
            $table->string('day_18');
            $table->string('day_19');
            $table->string('day_20');
            $table->string('day_21');
            $table->string('day_22');
            $table->string('day_23');
            $table->string('day_24');
            $table->string('day_25');
            $table->string('day_26');
            $table->string('day_27');
            $table->string('day_28');
            $table->string('day_29');
            $table->string('day_30');
            $table->string('day_31');
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
        Schema::dropIfExists('members');
    }
}
