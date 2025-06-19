<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('evaluations', function (Blueprint $table) {
            if (Schema::hasColumn('evaluations', 'circunferencias')) {
                $table->dropColumn('circunferencias');
            }
        });
    }

    public function down()
    {
        Schema::table('evaluations', function (Blueprint $table) {
            $table->text('circunferencias')->nullable();
        });
    }
};
