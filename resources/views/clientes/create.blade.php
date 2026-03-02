@extends('layouts.app')
@section('conteudo')

<div class="d-flex justify-content-between mb-4">
    <h2>Cadastrar Novo Cliente</h2>
    <!-- Botao para voltar a lista -->
    <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Voltar</a>
</div>

<!-- O Formulario -->
<!-- Quando clicar em "Salvar", os dados vao para a rota clientes.store (que guarda na base de dados) -->
<form action="{{ route('clientes.store') }}" method="POST">
    
    <!-- O 0csrf é o escudo de segurança OBRIGATORIO do Laravel. Sem ele, o formulário dá erro -->
    @csrf

    <div class="row">
        <!-- NOME E DATA DE NASCIMENTO -->
        <div class="col-md-8 mb-3">
            <label>Nome Completo</label>
            <input type="text" name="Nome" class="form-control" required>
        </div>
        <div class="col-md-4 mb-3">
            <label>Data de Nascimento</label>
            <input type="date" name="Data_Nascimento" class="form-control" required>
        </div>

        <!-- CEP -->
        <div class="col-md-3 mb-3">
            <label>CEP</label>
            <!-- Repare que demos um 'id="cep"' a este campo. E assim que o Javascript o vai encontrar (API) -->
            <input type="text" name="CEP" id="CEP" class="form-control" placeholder="Apenas números" required>
        </div>

        <!-- ENDEREÇO E NUMERO -->
        <div class="col-md-7 mb-3">
            <label>Endereço</label>
            <input type="text" name="Endereco" id="Endereco" class="form-control" required>
        </div>
        <div class="col-md-2 mb-3">
            <label>Número</label>
            <input type="text" name="numero" id="numero" class="form-control" required>
        </div>

        <!-- BAIRRO, CIDADE E UF -->
        <div class="col-md-4 mb-3">
            <label>Bairro</label>
            <input type="text" name="bairro" id="bairro" class="form-control" required>
        </div>
        <div class="col-md-6 mb-3">
            <label>Cidade</label>
            <input type="text" name="cidade" id="cidade" class="form-control" required>
        </div>
        <div class="col-md-2 mb-3">
            <label>UF</label>
            <input type="text" name="UF" id="UF" class="form-control" required>
        </div>
    </div>

    <!-- BOTAO DE SALVAR -->
    <button type="submit" class="btn btn-success mt-3">Salvar Cliente</button>

</form>

<!-- API -->
<script>
    // 1. O Javascript fica a "escutar" o campo do CEP
    // O evento 'blur' significa: "quando o utilizador clica fora da caixa de texto do CEP"
    document.getElementById('CEP').addEventListener('blur', function() {
        
        // Pega no numero que foi digitado
        let cepDigitado = this.value;

        // Se o utilizador digitou alguma coisa
        if(cepDigitado !== "") {
            
            // 2. Vai a "Janela de Drive-Thru" que foi criado no Laravel
            fetch('/api/cep/' + cepDigitado)
            // fetch (buscar) e a forma moderna do JavaScript de fazer uma requisicao para o servidor sem precisar atualizar a pagina inteira.
                .then(resposta => resposta.json()) // Transforma a resposta num formato que conseguimos ler
                .then(dados => {
                    
                    // Se a resposta vier com um erro (ex: CEP falso)
                    if(dados.erro) {
                        alert("CEP não encontrado.");
                    } else {
                        // 3. Sucesso. Preenche as caixas de texto automaticamente
                        document.getElementById('Endereco').value = dados.logradouro;
                        document.getElementById('bairro').value = dados.bairro;
                        document.getElementById('cidade').value = dados.localidade;
                        document.getElementById('UF').value = dados.uf;
                        
                        // Coloca o cursor a piscar dentro da caixa do 'Numero' para poupar tempo
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


