<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    // Public function é como o PHP chama uma "tarefa" ou "ação". 
    public function index() {

        // A variável $clientes vai receber TUDO (all) que está na tabela Cliente
        $clientes = Cliente::all();
        // O $clientes e uma variavel que ira guardar os dados que retornarem da tabela. E Cliente::all() equivale a SELECT * FROM clientes;

        // Pega a lista que acabamos de buscar e envia para a tela (view) chamada 'index'
        return view('clientes.index', compact('clientes'));
        // O View informar qual o arquivo que deve ser carregado, sendo o clientes.index servindo para indicar a pasta.
        //E ja o compact e uma funcao no php que pega a variavel clientes e "empacota" para que o view consiga enxergar (aparecer no html)
    }

    public function create () {
        // Apenas mostre a tela (view) chamada 'create'
        return view('clientes.create');
    }

    public function store(Request $request) {

        // Ele pega os dados salvos na variavel $request e confere se o cliente preencheu os campos obrigatorios
        $request->validate([
            'Nome' => 'required',
            'Data_Nascimento' => 'required',
            'CEP' => 'required',
            'Endereco' => 'required',
            'numero' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'UF' => 'required'
        ]);

        // Se passou pela conferencia, guarda no banco de dados (create cria uma linha com os dados)
        Cliente::create($request->all());

        // Manda o usuario de volta para a lista de clientes com uma mensagem verde
        return redirect()->route('clientes.index')->with('sucesso', 'Cliente cadastrado com sucesso!');
    
    }

    public function edit($id) {
        
        // O controler procura o cliente pelo ID (ex: cliente nº 5). 
        // Se nao encontrar (Fail), devolve um erro 404 automaticamente.
        $cliente = Cliente::findOrFail($id); 
        
        // Mostra a tela de edicao e envia os dados desse cliente para la
        return view('clientes.edit', compact('cliente'));
    
    }

    public function update(Request $request, $id)
    {
        // Faz a mesma conferencia de seguranca que no 'store'
        $request->validate([
            'Nome' => 'required',
            'Data_Nascimento' => 'required',
            'CEP' => 'required',
            'Endereco' => 'required',
            'numero' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'UF' => 'required'
        ]);

        // Acha o cliente antigo e atualiza (update) com o novo "pacote" ($request)
        $cliente = Cliente::findOrFail($id);
        $cliente->update($request->all()); 

        // Volta para a lista com mensagem de sucesso
        return redirect()->route('clientes.index')->with('sucesso', 'Cliente atualizado com sucesso!');
    }

    public function destroy($id)
    {
        // Acha o cliente pelo ID e apaga (delete)
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return redirect()->route('clientes.index')->with('sucesso', 'Cliente apagado com sucesso!');
    }

    public function buscarCep($CEP)
    {
        // 1. LIMPEZA DO CEP
        // As pessoas costumam digitar "88351-260" (com traço)
        // A funcao 'preg_replace' é uma ferramenta do PHP que diz: "Apague tudo o que NAO for numero"
        // Assim, o $cepLimpo fica apenas "88351260", que é como o ViaCEP gosta de receber
        $cepLimpo = preg_replace('/[^0-9]/', '', $CEP);


        // 2. A VIAGEM ATE AO VIACEP
        // O comando 'Http::get' faz o Laravel sair do computador e aceder ao link do ViaCEP
        // A variavel {$cepLimpo} esta no meio do link
        // A resposta do ViaCEP (a rua, a cidade, etc.) fica guardada na variável $resposta.
        // Adicionamos o withoutVerifying() aqui no meio, para que nao tenha problema por ser http
        $resposta = Http::withoutVerifying()->get("https://viacep.com.br/ws/{$cepLimpo}/json/");

        // 3. VERIFICACAO DE ERROS
        // E se o utilizador inventar um CEP que nao existe (ex: 00000000)?
        // O Laravel verifica se a viagem falhou (failed) ou se o ViaCEP devolveu a palavra 'erro'
        if ($resposta->failed() || isset($resposta['erro'])) {
            // Se deu erro, devolvemos uma mensagem de erro vermelha com o código 404 (Não Encontrado)
            return response()->json(['erro' => 'CEP não encontrado'], 404);
        }

        // 4. SUCESSO, DEVOLVER OS DADOS
        // Se correu tudo bem, pegamos na resposta do ViaCEP e transformamo-la num pacote de dados leve
        // chamado JSON (que no futuro ficheiro de ecrã vai conseguir ler e usar para preencher os campos)
        return $resposta->json();
    }

}
