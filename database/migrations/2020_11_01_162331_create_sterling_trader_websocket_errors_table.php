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
            $table->unsignedBigInteger('adapter_id')->nullable();
            $table->string('socket_id');
            $table->string('class');
            $table->smallInteger('code')->default(0);
            $table->text('message');
            $table->longText('trace');
            $table->timestamps();

            $table->foreign('adapter_id')->references('id')->on('sterling_trader_adapters')->cascadeOnDelete();
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
