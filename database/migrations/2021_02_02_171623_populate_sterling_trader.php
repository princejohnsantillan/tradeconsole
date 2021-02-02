<?php

use Illuminate\Database\Migrations\Migration;

class PopulateSterlingTrader extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
            INSERT INTO sterling_symbols (`symbol`)
            SELECT TRIM(BOTH \'"\' FROM message->"$.data.bstrSymbol") AS symbol 
            FROMsterling_trader_messages
            WHERE message->"$.data.bstrSymbol" IS NOT NULL
            GROUP BY TRIM(BOTH \'"\' FROM message->"$.data.bstrSymbol")
        ');
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
