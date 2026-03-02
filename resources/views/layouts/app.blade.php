<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Desafio</title>

    <!-- Importacao do Bootstrap pela internet (CSS)  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Importacao do CSS -->
    <link href="{{ asset('CSS/style.css') }}" rel="stylesheet">
    <!--  O asset() vai diretamente a pasta public e procura a pasta indicada. Se tentar colocar apenas href="css/style.css", o Laravel vai se perder -->

</head>
<body>

        <nav class="menu-personalizado">
        <div>
            Desafio - Cadastro de Clientes
        </div>
    </nav>

        <!-- O container centraliza o conteúdo no meio da tela -->
    <div class="container mt-4">
        
        <!-- MENSAGEM DE SUCESSO -->
        <!-- Se o Controlador mandar uma mensagem de 'sucesso', mostra uma caixa verde -->
        @if(session('sucesso'))
            <div class="alert alert-success">
                {{ session('sucesso') }}
            </div>
        @endif
        <!-- 0if(...): E o "Se" do Blade (motor de templates do Laravel). Ele verifica: "Existe uma mensagem de sucesso guardada na memoria agora?".
        session('sucesso'): Tenta ler essa mensagem que veio la do Controller.
        alert alert-success: Sao classes do Bootstrap que desenham aquela caixa verde bonita.
        As chaves duplas servem para imprimir o texto na tela de forma segura -->

        
        <!-- E aqui que as paginas de "Lista" e "Formulario" vao ser injetadas -->
        @yield('conteudo')
        <!-- Oyield funciona como um espaço reservado (um placeholder), aonde puxara os dados(conteudo) dos outros html --> 

    </div>

    
</body>
</html>