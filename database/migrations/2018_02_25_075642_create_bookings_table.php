<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatebookingsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('room_id');
            $table->datetime('startDateTime');
            $table->datetime('endDateTime');
            $table->datetime('deadlineForPaid');
            $table->String('customerName');
            $table->String('customerEmail')->nullable();
            $table->integer('players');
            $table->String('customerMobile');
            $table->String('customerLang')->default('ar');
            $table->double('total');
            $table->string('status')->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('bookings');
    }
}
