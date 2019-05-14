<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Fixroomstworr extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->boolean('live_performance_room')->nullable() ;
        });
    }

    /** Live performance room


     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
