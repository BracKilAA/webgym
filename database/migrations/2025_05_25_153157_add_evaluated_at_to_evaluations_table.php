<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('evaluations', function (Blueprint $table) {
            // Agrega la columna evaluated_at si no existe
            if (!Schema::hasColumn('evaluations', 'evaluated_at')) {
                $table->date('evaluated_at')->nullable();
            }
            // Agrega columnas de circunferencias si no existen
            if (!Schema::hasColumn('evaluations', 'pecho')) {
                $table->float('pecho')->nullable();
            }
            if (!Schema::hasColumn('evaluations', 'cintura')) {
                $table->float('cintura')->nullable();
            }
            if (!Schema::hasColumn('evaluations', 'cadera')) {
                $table->float('cadera')->nullable();
            }
            if (!Schema::hasColumn('evaluations', 'brazo')) {
                $table->float('brazo')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('evaluations', function (Blueprint $table) {
            $table->dropColumn(['evaluated_at', 'pecho', 'cintura', 'cadera', 'brazo']);
        });
    }
};
