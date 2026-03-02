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
        ### Aqui no up, voce coloca os dados que o Artesin automaticamente criara o banco de dados, adicionando as informacoes desejadas
        Schema::create('clientes', function (Blueprint $table) {
            $table->id(); ///Coloca automaticamente o id para cada cliente/pessoa
            $table->timestamps(); //Adiciona automaticamente quando o cliente/pessoa foi criado/atualizado
            $table->string('Nome');
            $table->date('Data_Nascimento'); // Como é data de nascimento, nao ha a necessidade de datas detalhada, sendo o date a melhor escolha (AAAA-MM-DD)
            $table->string('CEP', 9); // Usamos string devido, a os Zero a esquerda (Leanding zero), formatacao de mascara (ex: 00000-000) e nao tera nenhum conta, sendo usado para geometria
            $table->string('Endereco'); // Usamos string porque números de porta podem ter letras (ex: 11-Sala 03 (informacoes complementares))
            $table->string('numero');
            $table->string('bairro');
            $table->string('cidade');
            $table->string('UF', 2); // Limitamos a 2 caracteres para a sigla do estado (ex: SC)
        ###
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
