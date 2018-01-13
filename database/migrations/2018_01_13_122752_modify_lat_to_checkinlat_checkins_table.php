<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyLatToCheckinlatCheckinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('checkins', function (Blueprint $table) {
            $table->renameColumn('latitude', 'checkin_latitude');
            $table->renameColumn('longitude', 'checkin_longitude');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('checkins', function (Blueprint $table) {
            $table->renameColumn('checkin_latitude','latitude');
            $table->renameColumn('checkin_longitude','longitude');
            
        });
    }
}
