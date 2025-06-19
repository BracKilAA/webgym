<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('evaluations', function (Blueprint $table) {
            $table->float('pecho')->nullable();
            $table->float('cintura')->nullable();
            $table->float('cadera')->nullable();
            $table->float('brazo')->nullable();
        });
    }

    public function down()
    {
        Schema::table('evaluations', function (Blueprint $table) {
            $table->dropColumn(['pecho', 'cintura', 'cadera', 'brazo']);
        });
    }
};
