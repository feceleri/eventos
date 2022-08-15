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
                <a name="adicionar" id="btnAdicionar" class="btn btn-success float-right" href='<?php echo base_url('/cadastrarAtividades'); ?>' role="button"><i class="fa fa-plus" aria-hidden="true"></i>
                    Adicionar</a>
                <h2 class="card-title text-center">Atividades </h2>
                <table class="table table-hover" id="tabela">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>ID Evento</th>
                            <th>Titulo</th>
                            <th style="min-width: 180px;">Data Inicio</th>
                            <th style="min-width: 180px;">Data Fim</th>
                            <th>Certificado</th>
                            <th style="min-width: 80px;">Ações</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $key => $atividade) {
                            if ($atividade['tipo'] == '1') {
                                $tipo = 'Sim';
                            } else {
                                $tipo = 'Não';
                            }
                            echo '<tr><td>' . $atividade['id'] . '</td><td>' . $atividade['idEvento'] . '</td><td>' . $atividade['titulo'] . '</td><td>' . date_format(new DateTime($atividade['dtInicio']), "d/m/Y  - H:i") . '</td><td>' . date_format(new DateTime($atividade['dtFim']), "d/m/Y  - H:i") . '</td><td>' .  $tipo . '</td>
                               <td><a href=' . base_url('editarAtividades') . "/" . $atividade['id'] . '><i class="fa fa-edit" style="color: blue"></a></i>
                               <a href=' . base_url('atividades/deletar') . "/" . $atividade['id'] . '><i class="fa fa-trash"  style="color: red"></a></i>
                              </td></tr>';
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

<?= $this->section('js') ?>
<script>
  
    $msg = "";

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