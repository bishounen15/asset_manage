<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('type');
            $table->string('brand');
            $table->string('model');
            $table->string('serial');
            $table->string('os');
            $table->string('host_name');
            $table->string('site')->nullable();
            $table->string('sub_site')->nullable();
            $table->string('id_number');
            $table->string('name');
            $table->string('dept');
            $table->string('status');
            $table->string('device_status')->nullable();
            $table->string('proc');
            $table->string('ram');
            $table->string('hdd');
            $table->string('gfx_card')->nullable();
            $table->text('remarks')->nullable();

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
        Schema::dropIfExists('records');
    }
}
