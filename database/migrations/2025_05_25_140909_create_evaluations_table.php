<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluationsTable extends Migration
{
    public function up()
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('peso', 5, 2); // ejemplo: 70.50 kg
            $table->decimal('altura', 3, 2); // ejemplo: 1.75 m
            $table->json('circunferencias');
            $table->decimal('porcentaje_grasa', 5, 2);
            $table->json('fotos')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('evaluations');
    }
}
