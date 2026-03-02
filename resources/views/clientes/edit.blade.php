@extends('layouts.app')
@section('conteudo')

<div class="d-flex justify-content-between mb-4">
    <h2>Editar Cliente: {{ $cliente->nome }}</h2>
    <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Voltar</a>
</div>

<!-- O Formulario aponta para o UPDATE e passa o ID do cliente -->
<form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
    
    @csrf
    <!-- Formularios HTML nao entendem 'PUT', entao forcamos o Laravel a entender com esta linha: -->
    @method('PUT')

    <div class="row">
        <!-- NOME E DATA -->
        <!-- Repare no value="{{ $cliente->Nome }}". E isto que preenche a caixa com o nome antigo -->
        <div class="col-md-8 mb-3">
            <label>Nome Completo</label>
            <input type="text" name="Nome" class="form-control" value="{{ $cliente->Nome }}" required>
        </div>
        <div class="col-md-4 mb-3">
            <label>Data de Nascimento</label>
            <input type="date" name="Data_Nascimento" class="form-control" value="{{ $cliente->Data_Nascimento }}" required>
        </div>

        <!-- CEP -->
        <div class="col-md-3 mb-3">
            <label>CEP</label>
            <input type="text" name="CEP" id="CEP" class="form-control" value="{{ $cliente->CEP }}" required>
        </div>

        <!-- ENDERECO E NUMERO -->
        <div class="col-md-7 mb-3">
            <label>Endereço</label>
            <input type="text" name="Endereco" id="Endereco" class="form-control" value="{{ $cliente->Endereco }}" required>
        </div>
        <div class="col-md-2 mb-3">
            <label>Número</label>
            <input type="text" name="numero" id="numero" class="form-control" value="{{ $cliente->numero }}" required>
        </div>

        <!-- BAIRRO, CIDADE E UF -->
        <div class="col-md-4 mb-3">
            <label>Bairro</label>
            <input type="text" name="bairro" id="bairro" class="form-control" value="{{ $cliente->bairro }}" required>
        </div>
        <div class="col-md-6 mb-3">
            <label>Cidade</label>
            <input type="text" name="cidade" id="cidade" class="form-control" value="{{ $cliente->cidade }}" required>
        </div>
        <div class="col-md-2 mb-3">
            <label>UF</label>
            <input type="text" name="UF" id="UF" class="form-control" value="{{ $cliente->UF }}" required>
        </div>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Atualizar Cliente</button>

</form>

<!-- O MESMO JAVASCRIPT DO CEP -->
<!-- Se a pessoa editar o CEP, queremos que a rua atualize sozinha-->
<script>
    document.getElementById('CEP').addEventListener('blur', function() {
        let cepDigitado = this.value;
        if(cepDigitado !== "") {
            fetch('/api/cep/' + cepDigitado)
                .then(resposta => resposta.json())
                .then(dados => {
                    if(dados.erro) {
                        alert("CEP não encontrado.");
                    } else {
                        document.getElementById('Endereco').value = dados.logradouro;
                        document.getElementById('bairro').value = dados.bairro;
                        document.getElementById('cidade').value = dados.localidade;
                        document.getElementById('UF').value = dados.uf;
                        document.getElementById('numero').focus();
                    }
                })
                .catch(erro => {
                    alert("Ocorreu um erro ao procurar o CEP.");
                });
        }
    });
</script>

@endsection
