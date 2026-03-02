
<?php $__env->startSection('conteudo'); ?>

<div class="d-flex justify-content-between mb-4">
    <h2>Editar Cliente: <?php echo e($cliente->nome); ?></h2>
    <a href="<?php echo e(route('clientes.index')); ?>" class="btn btn-secondary">Voltar</a>
</div>

<!-- O Formulario aponta para o UPDATE e passa o ID do cliente -->
<form action="<?php echo e(route('clientes.update', $cliente->id)); ?>" method="POST">
    
    <?php echo csrf_field(); ?>
    <!-- Formularios HTML nao entendem 'PUT', entao forcamos o Laravel a entender com esta linha: -->
    <?php echo method_field('PUT'); ?>

    <div class="row">
        <!-- NOME E DATA -->
        <!-- Repare no value="<?php echo e($cliente->Nome); ?>". E isto que preenche a caixa com o nome antigo -->
        <div class="col-md-8 mb-3">
            <label>Nome Completo</label>
            <input type="text" name="Nome" class="form-control" value="<?php echo e($cliente->Nome); ?>" required>
        </div>
        <div class="col-md-4 mb-3">
            <label>Data de Nascimento</label>
            <input type="date" name="Data_Nascimento" class="form-control" value="<?php echo e($cliente->Data_Nascimento); ?>" required>
        </div>

        <!-- CEP -->
        <div class="col-md-3 mb-3">
            <label>CEP</label>
            <input type="text" name="CEP" id="CEP" class="form-control" value="<?php echo e($cliente->CEP); ?>" required>
        </div>

        <!-- ENDERECO E NUMERO -->
        <div class="col-md-7 mb-3">
            <label>Endereço</label>
            <input type="text" name="Endereco" id="Endereco" class="form-control" value="<?php echo e($cliente->Endereco); ?>" required>
        </div>
        <div class="col-md-2 mb-3">
            <label>Número</label>
            <input type="text" name="numero" id="numero" class="form-control" value="<?php echo e($cliente->numero); ?>" required>
        </div>

        <!-- BAIRRO, CIDADE E UF -->
        <div class="col-md-4 mb-3">
            <label>Bairro</label>
            <input type="text" name="bairro" id="bairro" class="form-control" value="<?php echo e($cliente->bairro); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label>Cidade</label>
            <input type="text" name="cidade" id="cidade" class="form-control" value="<?php echo e($cliente->cidade); ?>" required>
        </div>
        <div class="col-md-2 mb-3">
            <label>UF</label>
            <input type="text" name="UF" id="UF" class="form-control" value="<?php echo e($cliente->UF); ?>" required>
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\jinny\Herd\desafio\resources\views/clientes/edit.blade.php ENDPATH**/ ?>