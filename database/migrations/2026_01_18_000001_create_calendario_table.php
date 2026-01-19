<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tbl_calendario', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('id_proyecto');
            $table->BigInteger('id_proyecto');
            $table->boolean('estado')->default(true);
            $table->timestamps();

            // $table->foreign('id_proyecto')->references('id')->on('proyectos')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_calendario');
    }
};
