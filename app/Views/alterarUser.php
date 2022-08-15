<?= $this->extend('templates/default'); ?>
<?= $this->section('css'); ?>
<?= $this->endSection(); ?>
<?= $this->section('content') ?>
<main id="t3-content">
    <?php
    if (
        isset($_SESSION['id']) &&
        $_SESSION['type'] == 0
    ) {
        if (session()->get('success')) { ?>
            <script>
                $msg = '<?= session()->get('success'); ?>';
            </script>
        <?php } ?>

        <div class="container bg-white" style="padding-bottom: 10em;">
            <br>
            <a name="adicionar" id="btnAdicionar" class="btn btn-success float-right" href='<?php echo base_url('cadastrarUser'); ?>' role="button"><i class="fa fa-plus" aria-hidden="true"></i>
                Cadastrar</a>
            <h2 class="card-title text-center">Usuários</h2>
            <table class="table table-hover display" id="tabela">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Sobrenome</th>
                        <th>Nível</th>
                        <th>Ações</th> <!-- botão-->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $key => $user) {
                        if ($user['type'] == '0') {
                            $type = 'Administrador';
                        } else if ($user['type'] == '1') {
                            $type = 'Estudante';
                        } else if ($user['type'] == '2') {
                            $type = 'Farmacêutico';
                        } else {
                            $type = 'Outro profissional ';
                        }
                        echo '<tr><td>' . $user['id'] . '</td><td>' . $user['firstname'] . '</td><td>' . $user['lastname'] . '</td><td>' . $type . '</td>
                               <td><a href=' . base_url('editarUser') . "/" . $user['id'] . '><i class="fa fa-edit" style="color: blue"></a></i>
                               <a href=' . base_url('users/deletar') . "/" . $user['id'] . '><i class="fa fa-trash"  style="color: red"></a></i>
                               </td></tr>';
                    } ?>
                </tbody>
            </table>
        </div>
        <?php echo $pager->links(); ?>
    <?php
    } else {
        echo "<h3>Não tem permissão para acessar essa página!</h3>";
    }
    ?>
</main>
<?= $this->endSection() ?>
<?= $this->section('js'); ?>

<script>
    toastr.options = {
        "closeButton": true,
        "newestOnTop": false,
        "progressBar": true,
        "preventDuplicates": false,
        "positionClass": "toast-top-right",
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
    }

    if ($msg) {
        toastr.info($msg);
    }
</script>
<?= $this->endSection() ?>