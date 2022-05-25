<?= $this->extend('templates/default'); ?>

<?= $this->section('css'); ?>
<style>
    .inscritos {
        padding: 1rem;
    }

    h2 {
        text-align: center;
    }

    .table-sm {
        font-size: 11px;
    }

    p.btn.float-right {
        margin: 3px;
    }

    i.fa.fa-minus-circle {
        font-size: 17px;        
    }

    td:last-child {
        text-align: center;
    }
</style>
<?= $this->endSection(); ?>
<?= $this->section('content') ?>
<script>
    $msg = "";
</script>
<main>
    <?php if (session()->get('success')) { ?>
        <script>
            $msg = '<?= session()->get('success'); ?>';
        </script>
    <?php } else if (session()->get('info')) { ?>
        <script>
            $msg = '<?= session()->get('info'); ?>';
        </script>
    <?php } ?>
    <?php
    if (
        isset($_SESSION['id']) &&
        $_SESSION['type'] == 0
    ) {
    ?>
        <div class="container">
            <div class="bg-white inscritos">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('alterarEventos') ?>">Listar Eventos</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Inscritos</li>
                    </ol>
                </nav>
                <h2>
                    <?php echo $users[0]['idEvento'] . " - " . $users[0]['titulo']; ?>
                </h2>
                <p class="btn btn-success float-right">
                    Certificados <span class="badge badge-light"> <?php echo $certificado['total']; ?></span>
                </p>
                <p class="btn btn-primary float-right">
                    Concluíram <span class="badge badge-light"> <?php echo $inscritos; ?></span>
                </p>

                <p class="btn btn-light float-right">
                    Inscritos <span class="badge badge-light"> <?php echo count($users); ?></span>
                </p>
                <br><br><br>

                <table class="table table-hover table-sm">
                    <thead class="thead">
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>País</th>
                            <th>Estado</th>
                            <th>Categoria</th>
                            <th>Atividades</th>
                            <th>Data Cert.</th>
                            <th>Data Inscri.</th>
                            <th>Remover</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($users as $usuario) :

                            if ($usuario['type'] == 2) {
                                $cat = "Farmacêutico";
                            } else if ($usuario['type'] == 1) {
                                $cat = "Estudante";
                            } else {
                                $cat = "Administrador";
                            }

                            $remocaoHabilitada = false;
                            if (empty($usuario['atividadesconcluidas']) && empty($usuario['dataCertificado'])) {
                                $remocaoHabilitada = true;
                            }


                            echo "<tr>" .
                                "<td>" . $usuario['id'] . "</td>" .
                                "<td>" . $usuario['nome'] . "</td>" .
                                "<td>" . $usuario['email'] . "</td>" .
                                "<td>" . $usuario['pais'] . "</td>" .
                                "<td>" . $usuario['estado'] . "</td>" .
                                "<td>" . $cat . "</td>" .
                                "<td>" . $usuario['atividadesconcluidas'] . "</td>" .
                                "<td>";
                            if ($usuario['dataCertificado']) {
                                echo date_format(date_create($usuario['dataCertificado']), 'd/m/Y H:i:s') . "</td>";
                            } else {
                                echo "</td>";
                            }
                            echo "<td>" . date_format(date_create($usuario['dtInscricao']), 'd/m/Y H:i:s') . "</td>";
                            if ($remocaoHabilitada) {
                                echo "<td><a href='" . base_url('inicio/cancelarInscricaoUsuarioEvento/') . "/" . $usuario['id'] . "/" . $usuario['idEvento'] . "'><i class='fa fa-minus-circle text-danger' aria-hidden='true'></i></a></td>" . "</tr>";
                            } else {
                                echo "<td></td></tr>";
                            }


                        endforeach;

                        ?>
                    </tbody>
                </table>
            </div>
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
<?= $this->endSection(); ?>