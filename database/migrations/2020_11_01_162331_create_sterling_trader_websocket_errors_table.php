<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSterlingTraderWebsocketErrorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sterling_trader_websocket_errors', function (Blueprint $table) {
            $table->id();
            $table->string('socket_id')->nullable();
            $table->smallInteger('code')->default(0);
            $table->text('message');
            $table->longText('trace');
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
        Schema::dropIfExists('sterling_trader_websocket_errors');
    }
}
