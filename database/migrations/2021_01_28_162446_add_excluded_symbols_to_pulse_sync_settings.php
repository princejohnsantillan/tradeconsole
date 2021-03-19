<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExcludedSymbolsToPulseSyncSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pulse_sync_settings', function (Blueprint $table) {
            $table->string('excluded_symbols')->after('weight')->nullable();
        });
    }
}
