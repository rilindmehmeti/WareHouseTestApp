<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function(Blueprint $table) {
            $table->increments('id');
            $table->string('IMEI1');
            $table->string('IMEI2');
            $table->string('EAN');
            $table->enum('condition', ['new', 'opened', 'broken fixable', 'broken unfixable'])->default('new');
            $table->text('description');
            $table->integer('returnOrderId');
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
        Schema::drop('devices');
    }
}
