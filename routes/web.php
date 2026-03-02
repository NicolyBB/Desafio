<?php
### Criando os enderecamento

use Illuminate\Support\Facades\Route;
// Se o Routes é como uma prédio, no elevador para ele saber qual andar para, quem deve dizer é o ClienteController.
use App\Http\Controllers\ClienteController;

// Se o usuário entrar no site "vazio" (apenas a barra /, tipo localhost), redirecione-o automaticamente para a página de /clientes.
Route::get('/', function () { return redirect('/clientes'); });

Route::get('/clientes', [ClienteController::class, 'index']) -> name ('clientes.index'); // Se o usuário acessar /clientes, vá até o arquivo ClienteController e execute a função chamada index (que vai listar todos os clientes). Lista todos.
Route::get('/clientes/novo', [ClienteController::class,'create']) -> name ('clientes.create'); // Mostra formulario
Route::post('/clientes/salvar', [ClienteController::class, 'store'])->name('clientes.store'); // Guarda no banco
Route::get('/clientes/{id}/editar', [ClienteController::class, 'edit'])->name('clientes.edit'); // Mostra o formulário para editar
Route::put('/clientes/{id}/atualizar', [ClienteController::class, 'update'])->name('clientes.update'); // Atualiza no banco
Route::delete('/clientes/{id}/deletar', [ClienteController::class, 'destroy'])->name('clientes.destroy'); // Apaga


// ->name(...)? É um "apelido". No futuro, em vez de memorizarmos o endereço completo, nós usamos o apelido clientes.index.

Route::get('/api/cep/{cep}', [ClienteController::class, 'buscarCEP']);

###