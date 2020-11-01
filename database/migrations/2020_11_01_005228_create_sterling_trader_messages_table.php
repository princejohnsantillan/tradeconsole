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
            $table->string('adapter_key');
            $table->string('trader_id');
            $table->string('adapter_version');
            $table->json('message');
            $table->timestamps();

            $table->foreign('adapter_key')->references('key')->on('sterling_trader_adapters')->cascadeOnDelete();
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
