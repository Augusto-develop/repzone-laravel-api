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
        Schema::create('clientes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('cpf', 11)->unique();
            $table->string('nome', 150);
            $table->date('datanasc');
            $table->enum('sexo', ['M', 'F']);
            $table->string('endereco');
            $table->uuid('cidade_id');
            $table->timestamps();
            
            $table->foreign('cidade_id')->references('id')->on('cidades')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
