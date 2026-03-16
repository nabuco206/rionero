<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_proyectos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('nombre');
            $table->foreignId('id_comuna')->constrained('tbl_comunas')->onDelete('cascade');
            $table->string('supervisor_1')->nullable();
            $table->string('supervisor_2')->nullable();
            $table->integer('nmro_beneficiarios')->default(0);
            $table->integer('nmro_resolucion')->nullable();
            $table->date('fecha_resolucion')->nullable();
            $table->date('fecha_ini_obra')->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->foreignId('id_programa')->constrained('tbl_programas')->onDelete('cascade');
            $table->string('color')->nullable();
            $table->boolean('estado')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_proyectos');
    }
};
