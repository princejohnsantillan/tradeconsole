<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSterlingTraderConnectionActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //TODO:: unused in the app yet. revisit this idea.
        Schema::create('sterling_trader_connection_activities', function (Blueprint $table) {
            $table->id();
            $table->string('socket_id');
            $table->ipAddress('source');
            $table->dateTime('opened_at', 2);
            $table->dateTime('closed_at', 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sterling_trader_connection_activities');
    }
}
