<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSterlingTraderMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sterling_trader_messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('adapter_id');
            $table->string('socket_id');
            $table->string('trader_id')->index();
            $table->string('adapter_version')->index();
            $table->json('message');
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
        Schema::dropIfExists('sterling_trader_messages');
    }
}
