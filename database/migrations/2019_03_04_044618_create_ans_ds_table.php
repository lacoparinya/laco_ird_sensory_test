<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnsDsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ans_ds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ans_m_id');
            $table->integer('quiz_d_id');
            $table->integer('cus1_i');
            $table->integer('cus2_i');
            $table->integer('cus3_i');
            $table->integer('cus4_i');
            $table->integer('cus5_i');
            $table->integer('cus6_i');
            $table->string('cus1_s',50);
            $table->string('cus2_s', 50);
            $table->string('cus3_s', 50);
            $table->string('cus4_s', 50);
            $table->string('cus5_s', 50);
            $table->string('cus6_s', 50);
            $table->integer('created_by');
            $table->integer('modified_by');
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
        Schema::dropIfExists('ans_ds');
    }
}
