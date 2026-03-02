<!-- PECA 1: O ENCAIXE -->

<?php $__env->startSection('conteudo'); ?>

<!-- PECA 2: O TOPO -->
<div class="d-flex justify-content-between mb-4">
    <h2>Lista de Clientes</h2>
    
    <!-- Botao verde (btn-success) que leva para a Rota 'clientes.create' -->
    <a href="<?php echo e(route('clientes.create')); ?>" class="btn btn-success">
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
        <?php $__currentLoopData = $clientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cliente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr> <!-- Abre uma nova linha para este cliente -->
                
                <!-- Imprime os dados nas células usando as { } duplas (duas vezes) -->
                <td><?php echo e($cliente->id); ?></td>
                <td><?php echo e($cliente->Nome); ?></td>
                <td><?php echo e($cliente->CEP); ?></td>
                <td><?php echo e($cliente->cidade); ?> / <?php echo e($cliente->UF); ?></td>
                
                <!-- Celula com os botoes de Editar e Apagar -->
                <td>
                    <!-- Botao Azul (primary) de Editar -->
                    <a href="<?php echo e(route('clientes.edit', $cliente->id)); ?>" class="btn btn-primary btn-sm">Editar</a>
                    
                    <!-- O Botao Vermelho (danger) de Apagar tem de estar dentro de um form por segurança -->
                    <form action="<?php echo e(route('clientes.destroy', $cliente->id)); ?>" method="POST" style="display: inline-block;">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Quer mesmo apagar?')">Apagar</button>
                    </form>
                </td>

            </tr> <!-- Fecha a linha deste cliente. Se houver mais, a maquina repete -->
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </tbody>
</table>

<!-- FIM DO ENCAIXE -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\jinny\Herd\desafio\resources\views/clientes/index.blade.php ENDPATH**/ ?>