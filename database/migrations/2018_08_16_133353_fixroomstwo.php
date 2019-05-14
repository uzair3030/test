<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Fixroomstwo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rooms', function (Blueprint $table) {
            
            $table->string('image_en')->nullable() ;
            $table->string('image1')->nullable()->change() ;
            $table->string('image2')->nullable()->change() ;
            $table->string('image3')->nullable()->change() ;
            $table->string('videoUrl')->nullable()->change() ;

            $table->dropColumn('capacity_en') ;
            $table->dropColumn('duration_en') ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
