<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
       Schema::table('plans', function (Blueprint $table) {
    $table->text('ejercicios')->nullable()->change();
});

    }

    public function down(): void
    {
        Schema::table('plans', function (Blueprint $table) {
            $table->string('ejercicios')->change();
        });
    }
};
