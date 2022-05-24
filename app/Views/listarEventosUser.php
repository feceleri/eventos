<?= $this->extend('templates/default'); ?>
<?= $this->section('css'); ?>
<style>
    .card-title {
        text-align: center;
        margin-top: 5px;
        font-size: 1em;
    }

    .card-header {
        /* height: 100px; */
        overflow: hidden;
        font-size: 1em;
    }

    .card-text {
        margin-top: 20px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .card-body {
        min-height: 500px;
    }

    .card-footer {
        margin-top: -30px;
    }

    .card {
        padding: 5px;
        border-width: medium;
        max-width: 360px;
        margin: 5px;
        box-shadow: -11px 7px 8px -4px darkgrey;
        margin-bottom: 21px;
    }

    .card {
        border: none;
        box-shadow: 0 1px 3px rgb(0 0 0 / 12%), 0 1px 2px rgb(0 0 0 / 24%);
    }

    .card,
    .card-body {
        padding: 0;
    }


    #encerramento {
        margin-top: 15px;
        margin-left: 15px;
    }

    .btn {
        background-color: #008CBA;
        margin-left: 5px;
        margin-top: 10px;
        text-align: center;
        height: 40px;
        color: white;
    }    

    .btn:hover {

        background-color: #0b3e7a;
    }
</style>
<?= $this->endSection() ?>

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
    <div class="container" style="padding-bottom: 10em;">
        <h2 style="text-align: center;" title="Minhas Inscrições"> Minhas Inscrições</h2>
        <br>

        <div class="row">
            <?php if (count($data) > 0) { ?>
                <?php foreach ($data as $key => $evento) {
                    $htm =
                        '<div class="card">'
                        . '<div class="card-header" id="card-header" style="background-color:' .  $evento['corPrimaria'] . '">'
                        . '<h4 class="card-title" >' . $evento['titulo'] . '</h4>'
                        . '</div>'
                        .  '<div class="card-body">'

                        . '<img  src="' .  base_url("/public/img") . "/" . $evento['imagem'] . '" alt="imagem proncipal do evento" width="100%">'

                        . '<p id="encerramento"> <strong>Evento encerra:</strong> ' . date_format(new DateTime($evento['dtFim']), "d-m-Y") . ' ' . 'às' . ' ' . date_format(new DateTime($evento['dtFim']), "H:i") . ' ' . 'horas.</p>'
                        . '</div>'
                        . '<div class="card-footer text-muted" id="card-footer" >'
                        . '<ul class="nav nav-pills ">'

                        . '<li class="nav-item">'
                        . '<a class="btn btn-primary"    href="' . base_url("inicio/listaEvento") . "/" . $evento['id'] . '">Ingressar</a>'
                        . '</li>';

                    '<li class="nav-item" >';
                    if ($evento['Expirado'] == 'Sim') {
                        $htm .= '<a  data-toggle="modal"';
                        if ($evento['certificado'] == 'Evento não gera certificado.') {
                            $htm .= 'data-target="#certificadoModalN"'
                                . ' class="btn btn-primary" id="cad1" >Informação</a>';
                        } else if ($evento['certificado'] == 'Não concluiu todas as atividades.') {
                            $htm .= 'data-target="#certificadoModalNC"'
                                . ' class="btn btn-primary" id="cad1" >Informação</a>';
                        } else {
                            $htm .= 'data-target="#certificadoModal"'
                                . 'onclick="setarCampos(' . $evento['id'] . ');"  class="btn btn-primary" style="color: white;" >Certificado</a>';
                        }
                    }

                    $htm .= '</li></ul>'
                        . '</div>'
                        . '</div>';

                    echo $htm;
                }
                ?>

        </div>
    </div>
    </div>
    </div>

<?php

            } else {
                echo "<h3>Não esta cadastrado em nenhum evento!</h3>";
            }
?>

</div>
<!-- Modal vizualização do pré-certificado -->
<div class="modal fade " data-backdrop="static" id="certificadoModal" tabindex="-1" role="dialog" aria-labelledby="certificadoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="certificadoModalLabel" style="text-align: center;">Olá <?= session()->get('firstname') ?>, bem-vindo(a)! </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p style="text-align: justify;"> Antes de emitir o certificado, clique no link abaixo e confira se o seu nome está correto. Caso queira alterar, clique no canto superior direito no seu nome e clique em editar.</p>
                <a href="" target="_blank" id="vizualizar">Visualização do certificado</a>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label box" for="flexCheckDefault">
                        Declaro para os devidos fins que participei desse evento e não poderei alterar os dados após a emissão do certificado.
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button href='#' type="button" class="btn btn-secondary" id="cad" data-dismiss="modal" onclick="document.location.reload(true)">Fechar</button>
                <a href="#" class="btn btn-primary emitir disabled" id="btnEmitir">Emita aqui seu certificado!</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal não concluiu todas as atividades -->
<div class="modal fade" data-backdrop="static" id="certificadoModalNC" tabindex="-1" role="dialog" aria-labelledby="certificadoModalNC" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="certificadoModalNC" style="text-align: center;">Olá <?= session()->get('firstname') ?>, </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p style="text-align: justify;"> Infelizmente não é possivel gerar certificado para esse evento, pois todas as atividades não foram concluídas.</p>
            </div>

        </div>
    </div>
</div>

<!-- Modal não gera certificado -->
<div class="modal fade" data-backdrop="static" id="certificadoModalN" tabindex="-1" role="dialog" aria-labelledby="certificadoModalN" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="certificadoModalN" style="text-align: center;">Olá <?= session()->get('firstname') ?>, </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p style="text-align: justify;"> Infelizmente esse evento não gera certificado!</p>
            </div>
        </div>
    </div>
</div>

<!-- Modal atividade não realizada -->
<div class="modal fade" data-backdrop="static" id="sobreModal" tabindex="-1" aria-labelledby="sobreModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="certificadoModalN" style="text-align: center;"> Aviso </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p style="text-align: justify;"> Infelizmente Atividade já encerrou!</p>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('js'); ?>
<script>
    $('.form-check-input').on('change', function() {
        if (this.checked) {
            //Do stuff
            $("#btnEmitir").removeClass("disabled");

        } else {
            $("#btnEmitir").addClass("disabled");

        }
    });

    //-----------------------------------------------------------------------------
    function setarCampos($id) {
        var link = '<?php echo (base_url("/certificadoVizualizacao") . "/");  ?>';
        document.getElementById("vizualizar").href = link + $id;
        var link = '<?php echo (base_url("/eventos/gerarCertificado") . "/");  ?>';
        document.getElementById("btnEmitir").href = link + $id;
    }

    function inscreverAtividade($id) {
        var link = '<?php echo (base_url("/atividades/inscreverAtividade") . "/");  ?>';
        document.getElementById("cad").href = link + $id;
    }
    //-----------------------------------------------------------------------------

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
</main>
<?= $this->endSection() ?>