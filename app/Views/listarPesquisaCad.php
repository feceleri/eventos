<?= $this->extend('default') ?>

<?= $this->section('content') ?>
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css" />
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script> -->


<style>
    h2 {
        color: #092e48;
        margin-top: 20px;
    }

    .fa-trash {
        margin-left: 10px;
        margin-right: 10px;
    }

    th {
        color: white;
        text-align: left;
        margin-top: 20px;
        font: caption;
    }

    .session {
        float: right;
        font-size: 16px;
    }

    thead {
        text-align: center;
    }

    #tabela {
        width: 100%;
        border: solid 2px;
        text-align: left;
        border-collapse: collapse;
    }

    #tabela tbody tr {
        border: solid 1px;
        height: 30px;
        cursor: pointer;
    }

    #tabela thead {
        background: #0174DF;
        border: solid 2px;
        opacity: 0.7;
    }

    #tabela thead th:nth-child(1) {
        width: 100px;
    }

    #tabela input {
        color: navy;
    }

    h3 {
        margin-top: 50px;
        text-align: center;
        color: red;
    }

    #cadPesq {
        width: 150px;
        background-color: #008CBA;
        font-size: 12px;
        border-radius: 8px;
        border: 2px solid;
        float: right;
        margin-top: 10px;
    }

    #cad {
        width: 100px;
        background-color: #008CBA;
        font-size: 12px;
        border-radius: 8px;
        border: 2px solid;
        float: right;
        margin: 10px;
    }

    #cadGrafico {
        width: 100px;
        background-color: #008CBA;
        font-size: 12px;
        border-radius: 8px;
        border: 2px solid;
        float: right;
        margin: 10px;
    }

    #cad:hover,
    #cadPesq:hover,
    #cadGrafico:hover {
        box-shadow: 0 12px 16px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0 rgba(0, 0, 0, 0.19);
    }

    /* .anchor {

    } */

    [data-tooltip]:hover:after {
        display: block;
    }

    [data-tooltip] {
        position: relative;
        font-weight: inherit;
    }

    [data-tooltip]:after {
        display: none;
        position: absolute;
        top: -5px;
        padding: 3px;
        border-radius: 2px;
        left: calc(100% + 2px);
        content: attr(data-tooltip);
        white-space: nowrap;
        background-color: #0095ff;
        color: White;
    }


    @media only screen and (min-width: 1200px) {
        .session {
            margin-left: 150px;
            text-transform: uppercase;
        }

        .evento {
            margin-left: -50px;
        }

        .menu {
            margin-left: 200px;
        }

        .nav2 {
            margin-left: 50px;
            margin-right: 50px;
        }

        .pesq {
            margin-left: 50px;
        }

        .campanha {
            margin-left: 50px;
        }
    }
</style>
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

            <div class="row">
                <div class="col-12" id="divConteudo">
                    <h2 style="text-align: center; font-size:30px">Pesquisas Cadastradas</h2>
                    <a class="btn btn-primary  text-uppercase" id="cad" type="submit" href="<?= base_url('cadastrarPesquisa') ?>">Cadastrar</a>
                    <a class="btn btn-primary  text-uppercase" id="cadPesq" type="submit" href="<?= base_url('relatorioGeral') ?>">Relatorio Geral</a>
                    <a class="btn btn-primary  text-uppercase" id="cadGrafico" type="submit" href="<?= base_url('pesquisa/relatorioGrafico') ?>">Gráfico</a>
                    <?php if (session()->get('success')) { ?>
                        <script>
                            $msg = '<?= session()->get('success'); ?>';
                        </script>
                    <?php } ?>

                    <table class="table table-hover display" id="tabela" style="width:100%">
                        <thead>
                            <tr>
                                <th style=" width: 16px;">ID</th>
                                <th>Titulo</th>
                                <th>Tema</th>
                                <th>Data</th>
                                <th>Data Expiração</th>
                                <th>Forma</th>
                                <!-- <th>criado</th> -->
                                <th>Ações</th> <!-- botão-->
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
                                echo ' <a href="' . base_url('pesquisa/relatorioPesquisa') . "/" . $pesquisa['id'] . '" id="baixar" ><i class="fa fa-file-excel-o"    style="color: black"></i></a>';
                                echo ' <a href="' . base_url('pesquisa/relatorioGrafico') . "/" . $pesquisa['id'] . '"  ><i class="fa fa-pie-chart" aria-hidden="true" ></i></a></td></tr>';
                            } ?>



                        </tbody>
                    </table>
                </div>
            </div>
        <?php
    } else {
        echo "<h3>Não tem permissão para acessar essa página!</h3>";
    }
        ?>
        </div>
</main>
<script>
    $(document).ready(function() {
        $('#tabela').DataTable({
            // "order": [
            //     [5, "desc"]
            // ],
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json'
            }
        });
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

    function ocultar() {
        document.getElementById("oculto").style.display = "none";
    }

    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
<style>
    .sorting_1,
    .sorting_2,
    .sorting_3,
    .odd {
        background-color: #fff !important;
    }

    .deleted>td {
        background-color: #ccc !important;
    }
</style>
<?= $this->endSection() ?>