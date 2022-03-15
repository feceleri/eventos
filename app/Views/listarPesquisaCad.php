<?= $this->extend('templates/default'); ?>
<?= $this->section('css'); ?>
<style>
    a.btn {
        margin-right: 4px;
    }    
    .deleted>td {
        background-color: #ccc !important;
    }
</style>
<?= $this->endSection(); ?>
<?= $this->section('content') ?>
<script>
    $msg = "";
</script>
<main id="t3-content">
    <?php
    if (
        isset($_SESSION['id']) &&
        $_SESSION['type'] == 0
    ) {
    ?>
        <div class="container bg-white" style="padding-bottom: 10em;">
            <br>
            <a class="btn btn-success float-right" id="cad" type="submit" href="<?= base_url('cadastrarPesquisa') ?>"><i class="fa fa-plus" aria-hidden="true"></i> Cadastrar</a>
            <a class="btn btn-success float-right" id="cadPesq" type="submit" href="<?= base_url('relatorioGeral') ?>">Relatório Geral</a>
            <a class="btn btn-success float-right" id="cadGrafico" type="submit" href="<?= base_url('pesquisa/relatorioGrafico') ?>">Gráficos</a>
            <div><h2 class="card-title text-center">Pesquisas Cadastradas</h2></div>            
            <div class="row">
                <div class="col-12" id="divConteudo">
                    <?php if (session()->get('success')) { ?>
                        <script>
                            $msg = '<?= session()->get('success'); ?>';
                        </script>
                    <?php } ?>
                    <div class="table-responsive">
                        <table class="table table-hover display" id="tabela">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Titulo</th>
                                    <th>Tema</th>
                                    <th>Data</th>
                                    <th>Data Expiração</th>
                                    <th>Forma</th>
                                    <th style="min-width: 100px;">Ações</th>
                                </tr>

                            </thead>
                            <tbody id="cadastro">
                                <?php foreach ($data as $key => $pesquisa) {
                                    if ($pesquisa['forma'] == '1') {
                                        $forma = 'Presencial';
                                    } else {
                                        $forma = 'Online';
                                    }
                                    if ($pesquisa['temas']  == '1') {
                                        $temas = 'Campanha de saúde';
                                    } else if ($pesquisa['temas']  == '2') {
                                        $temas = 'Capacitação';
                                    } else if ($pesquisa['temas']  == '3') {
                                        $temas = 'Curso';
                                    } else if ($pesquisa['temas']  == '4') {
                                        $temas = 'Fiscalização Orientativa';
                                    } else if ($pesquisa['temas']  == '5') {
                                        $temas = 'Encontro';
                                    } else if ($pesquisa['temas']  == '6') {
                                        $temas = 'Fórum';
                                    } else if ($pesquisa['temas']  == '7') {
                                        $temas = 'Palestra';
                                    } else if ($pesquisa['temas']  == '8') {
                                        $temas = 'Seminário';
                                    } else if ($pesquisa['temas']  == '9') {
                                        $temas = 'Simpósio';
                                    } else if ($pesquisa['temas']  == '10') {
                                        $temas = 'Trilha de aprendizagem';
                                    } else {
                                        $temas = 'Webinar ';
                                    }

                                    if ($pesquisa['data'] == '0000-00-00 00:00:00') {
                                        $data = '';
                                    } else {
                                        $data = date_format(new DateTime($pesquisa['data']), "d/m/Y");
                                    }

                                    if ($pesquisa['data_exc'] == '0000-00-00 00:00:00' || $pesquisa['data_exc'] == null) {
                                        $dataExc = '';
                                    } else {
                                        $dataExc = date_format(new DateTime($pesquisa['data_exc']), "d/m/Y");
                                    }


                                    if ($pesquisa['deleted_at'] && $pesquisa['data_exc'] != '0000-00-00 00:00:00') {
                                        echo '<tr class="deleted"><td>' . $pesquisa['id'] . '</td><td>' . $pesquisa['titulo'] . '</td><td>' . $temas . '</td><td>' . $data . '</td><td>' . $dataExc . '</td><td>' . $forma . '</td>
                                    <td><a href="' . base_url('pesquisa/ocultarAtividade') . "/" . $pesquisa['id'] . '"><i class="fa fa-square-o" aria-hidden="true" style="color: green, margin-left: 15px," id="click"></i></a>';
                                    } else {
                                        echo '<tr><td>' . $pesquisa['id'] . '</td><td>' . $pesquisa['titulo'] . '</td><td>' . $temas . '</td><td>' . $data . '</td><td>' . $dataExc . '</td><td>' . $forma . '</td>
                                    <td><a href="' . base_url('pesquisa/ocultarAtividade') . "/" . $pesquisa['id'] . '"><i class="fa fa-check-square-o" aria-hidden="true" id="oculto" style="color: green"></i></a>';
                                        echo  ' <a href="' . base_url('pesquisa/editarPesquisa') . "/" . $pesquisa['id'] . '"  ><i class="fa fa-edit" style="color: blue"></a></i>';
                                    }
                                    echo ' <a href="' . base_url('pesquisa/relatorioPesquisa') . "/" . $pesquisa['id'] . '" id="baixar" ><i class="fa fa-file-excel-o" style="color: black"></i></a>';
                                    echo ' <a href="' . base_url('pesquisa/relatorioGrafico') . "/" . $pesquisa['id'] . '" ><i class="fa fa-pie-chart" aria-hidden="true" ></i></a></td></tr>';
                                } ?>



                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php
    } else {
        echo "<h3>Não tem permissão para acessar essa página!</h3>";
    }
        ?>
        </div>
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

    function ocultar() {
        document.getElementById("oculto").style.display = "none";
    }

    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
<?= $this->endSection(); ?>