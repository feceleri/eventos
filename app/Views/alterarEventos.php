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
            <a name="adicionar" id="btnAdicionar" class="btn btn-success float-right" href='<?php echo base_url('cadastrarEventos'); ?>' role="button"><i class="fa fa-plus" aria-hidden="true"></i>
                Cadastrar</a>
            <h2 class="card-title text-center">Eventos </h2>
            <table class="table table-hover display" id="tabela" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titulo</th>
                        <th style="min-width: 180px;">Data Inicio</th>
                        <th style="min-width: 180px;">Data Fim</th>
                        <th>Criado</th>
                        <th style="min-width: 80px;">Ações</th> 
                    </tr>

                </thead>
                <tbody>
                    <?php foreach ($data as $key => $evento) {
                        echo '<tr><td>' . $evento['id'] . '</td><td>' . $evento['titulo'] . '</td><td>' . date_format(new DateTime($evento['dtInicio']), "d/m/Y - H:i") . '</td><td>' . date_format(new DateTime($evento['dtFim']), "d/m/Y - H:i") . '</td><td>' . $evento['userCreated'] . '</td>
                               <td><a href=' . base_url('editarEventos') . "/" . $evento['id'] . '  ><i class="fa fa-edit" style="color: blue"></a></i>
                               <a href=' . base_url('eventos/deletar') . "/" . $evento['id'] . '><i class="fa fa-trash"  style="color: red"></a></i>
                               <a href=' . base_url('inscritos/relatorioEvento') . "/" . $evento['id'] . ' id="baixar" ><i class="fa fa-file-excel-o"    style="color: black"></i></a></td></tr>';
                    } ?>
                </tbody>
            </table>
        </div>
    <?php
    } else {
        echo "<h3>Não tem permissão para acessar essa página!</h3>";
    }
    ?>
</main>
<?= $this->endSection() ?>
<?= $this->section('js'); ?>
<script>
    $msg = "";

    $(document).ready(function() {
        // $('#tabela').DataTable({
        //     language: {
        //         url: 'https://cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json'
        //     }
        // });
    });

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