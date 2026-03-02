<!-- PECA 1: O ENCAIXE -->
@extends('layouts.app')
@section('conteudo')

<!-- PECA 2: O TOPO -->
<div class="d-flex justify-content-between mb-4">
    <h2>Lista de Clientes</h2>
    
    <!-- Botao verde (btn-success) que leva para a Rota 'clientes.create' -->
    <a href="{{ route('clientes.create') }}" class="btn btn-success">
        + Cadastrar Novo
    </a>
</div>

<!-- PECA 3: A TABELA -->
<table class="table table-bordered table-striped">
    
    <!-- Cabeca da tabela (As colunas cinzentas do topo) -->
    <thead class="table-dark">
        <tr> <!-- Abre a linha -->
            <th>ID</th> <!-- Coluna 1 -->
            <th>Nome do Cliente</th> <!-- Coluna 2 -->
            <th>CEP</th> <!-- Coluna 3 -->
            <th>Cidade / Estado</th> <!-- Coluna 4 -->
            <th>Opções</th> <!-- Coluna 5 -->
        </tr> <!-- Fecha a linha -->
    </thead>

    <!-- Corpo da tabela (Onde os dados vao entrar) -->
    <tbody>
        
        <!-- O LOOP (A MAQUINA DE REPETICAO) -->
        <!-- O 0foreach pega na lista de $clientes e, a cada volta, chama a um único de $cliente -->
        @foreach ($clientes as $cliente)
            <tr> <!-- Abre uma nova linha para este cliente -->
                
                <!-- Imprime os dados nas células usando as { } duplas (duas vezes) -->
                <td>{{ $cliente->id }}</td>
                <td>{{ $cliente->Nome }}</td>
                <td>{{ $cliente->CEP }}</td>
                <td>{{ $cliente->cidade }} / {{ $cliente->UF }}</td>
                
                <!-- Celula com os botoes de Editar e Apagar -->
                <td>
                    <!-- Botao Azul (primary) de Editar -->
                    <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-primary btn-sm">Editar</a>
                    
                    <!-- O Botao Vermelho (danger) de Apagar tem de estar dentro de um form por segurança -->
                    <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Quer mesmo apagar?')">Apagar</button>
                    </form>
                </td>

            </tr> <!-- Fecha a linha deste cliente. Se houver mais, a maquina repete -->
        @endforeach

    </tbody>
</table>

<!-- FIM DO ENCAIXE -->
@endsection
