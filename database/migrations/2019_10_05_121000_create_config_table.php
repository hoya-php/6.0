<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('group_id');
            $table->integer('shift_id');
            $table->integer('type_pattern')->default(0);
            $table->integer('year');
            $table->integer('month');
            $table->string('config_1');
            $table->string('config_2');
            $table->string('config_3');
            $table->string('config_4');
            $table->string('config_5');
            $table->string('config_6');
            $table->string('config_7');
            $table->string('config_8');
            $table->string('config_9');
            $table->string('config_10');
            $table->string('config_11');
            $table->string('config_12');
            $table->string('config_13');
            $table->string('config_14');
            $table->string('config_15');
            $table->string('config_16');
            $table->string('config_17');
            $table->string('config_18');
            $table->string('config_19');
            $table->string('config_20');
            $table->string('config_21');
            $table->string('config_22');
            $table->string('config_23');
            $table->string('config_24');
            $table->string('config_25');
            $table->string('config_26');
            $table->string('config_27');
            $table->string('config_28');
            $table->string('config_29');
            $table->string('config_30');
            $table->string('config_31');
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
        Schema::dropIfExists('config');
    }
}
