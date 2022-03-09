<?= $this->extend('templates/default'); ?>
<?= $this->section('css'); ?>
<style>
    .custom-file-input~.custom-file-label::after {
        content: "Selecionar";
    }
</style>
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
        width: 100%;
    }

    h3 {
        margin-top: 50px;
        text-align: center;
        color: red;
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

    #cad:hover {
        box-shadow: 0 12px 16px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0 rgba(0, 0, 0, 0.19);
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

            <div class="row">
                <div class="col-12" id="divConteudo">
                    <h2 style="text-align: center; font-size:30px">Eventos</h2>
                    <a class="btn btn-primary  text-uppercase" id="cad" type="submit" href="<?= base_url('cadastrarEventos') ?>">Cadastrar</a>

                    <?php if (session()->get('success')) { ?>
                        <script>
                            $msg = '<?= session()->get('success'); ?>';
                        </script>
                    <?php } ?>

                    <table class="table table-hover display" id="tabela" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Titulo</th>
                                <th>Data Inicio</th>
                                <th>Data Fim</th>
                                <th>criado</th>
                                <th>Ações</th> <!-- botão-->
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
    $(document).ready(function() {
        $('#tabela').DataTable({
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
</script>
<?= $this->endSection() ?>