<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    ### Estamos informando quais sao os campos que podem ser preenchidos

    //é uma trait (um conjunto de métodos reutilizáveis) incluída nos modelos Eloquent (a partir do Laravel 8) que serve para simplificar a criação de registros falsos (fakes) ou de teste, utilizando as "Factories" do Laravel
    use HasFactory;

    // Fillable - Tem como objetivo a seguranca, indicando quais campos podem ser preenchidos sendo automatica
    //Aqui dizemos quais campos podem ser guardados pelo formulário
    protected $fillable = [
        'Nome',
        'Data_Nascimento',
        'CEP',
        'Endereco',
        'numero',
        'bairro',
        'cidade',
        'UF'
    ];
    ###
}
