<?= $this->extend('default') ?>

<?= $this->section('content') ?>
<link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>


<style>
    body {

        background-color: #F5F5F5;
    }

    h2 {
        color: #092e48;
    }

    #cad {
        width: 200px;
        background-color: #008CBA;
        font-size: 12px;
        padding: 12px 28px;
        border-radius: 8px;
        border: 2px solid;
    }

    #cad:hover {
        box-shadow: 0 12px 16px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0 rgba(0, 0, 0, 0.19);
    }

    .data {
        width: 200px;
    }

    .forma{
        width: 250px;
        margin-left: 43%;
        margin-top: -4.6%;
    }

    .cidades{
        width: 250px;
        margin-top: -4.5%;
        float: right;
        margin-right: 3%;
    }


    @media only screen and (min-width: 1400px) {
        .session {
            margin-left: 150px;
            text-transform: uppercase;
        }

        .evento{
            margin-left: -50px;
        }

        .menu {
            margin-left: 200px;
        }

        .nav2 {
            margin-left: 50px;
            margin-right: 50px;
        }
        .pesq{
            margin-left: 50px;
        }

        .campanha{
            margin-left: 50px;
        }

    }



    @media (max-width: 650px) {

        .data {
            width: 200px;
        }

        #cad {
            width: 200px;
            background-color: #008CBA;
            font-size: 12px;
            padding: 12px 28px;
            border-radius: 8px;
            border: 2px solid;
            margin-top: 100px;
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
    <div class="row">
        <div class="container">
            <?php if (session()->get('success')) { ?>
            <script>
                $msg = '<?= session()->get('success'); ?>';
            </script>
            <?php } ?>
            <div class="mx-auto ">
                <div class="card">
                    <div class="card-body">
                    <a href="<?= base_url('listaPesquisa') ?>">Voltar</a>
                        <h2 class="card-title text-center col-12">Alteração de Pesquisa</h2>
                        </br></br>

                        <form class="form-signin" name='form1' method="POST">

                            <div class="form-group">
                                <div class="form-label-group">
                                    <input type="text" id="titulo" name="titulo" class="form-control col-12"
                                        placeholder="Titulo" maxlength="60" minilength="3" value="<?= $data["titulo"] ?>"
                                        required autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-label-group" required>
                                    <select id="temas" name="temas" class="form-control">
                                        <?php
                                            if ((int)$data['temas'] == 1) {
                                                echo '<option value="1" id="1">Campanha de saúde</option>';
                                                echo '<option value="2" id="2">Capacitação</option>';
                                                echo '<option value="3" id="3">Curso</option>';
                                                echo '<option value="4" id="4">Fiscalização Orientativa</option>';
                                                echo '<option value="5" id="5">Encontro</option>';
                                                echo '<option value="6" id="6">Fórum</option>';
                                                echo '<option value="7" id="7">Palestra</option>';
                                                echo '<option value="8" id="8">Seminário</option>';
                                                echo '<option value="9" id="9">Simpósio</option>';
                                                echo '<option value="10" id="10">Trilha de aprendizagem</option>';
                                                echo '<option value="11" id="11"">Webinar</option>';
                                            } else if((int)$data['temas'] == 2){
                                                echo '<option value="1" id="1">Campanha de saúde</option>';
                                                echo '<option value="2" id="2" selected="selected">Capacitação</option>';
                                                echo '<option value="3" id="3">Curso</option>';
                                                echo '<option value="4" id="4">Fiscalização Orientativa</option>';
                                                echo '<option value="5" id="5">Encontro</option>';
                                                echo '<option value="6" id="6">Fórum</option>';
                                                echo '<option value="7" id="7">Palestra</option>';
                                                echo '<option value="8" id="8">Seminário</option>';
                                                echo '<option value="9" id="9">Simpósio</option>';
                                                echo '<option value="10" id="10">Trilha de aprendizagem</option>';
                                                echo '<option value="11" id="11"">Webinar</option>';
                                            }else if((int)$data['temas'] == 3){
                                                echo '<option value="1" id="1">Campanha de saúde</option>';
                                                echo '<option value="2" id="2">Capacitação</option>';
                                                echo '<option value="3" id="3" selected="selected">Curso</option>';
                                                echo '<option value="4" id="4">Fiscalização Orientativa</option>';
                                                echo '<option value="5" id="5">Encontro</option>';
                                                echo '<option value="6" id="6">Fórum</option>';
                                                echo '<option value="7" id="7">Palestra</option>';
                                                echo '<option value="8" id="8">Seminário</option>';
                                                echo '<option value="9" id="9">Simpósio</option>';
                                                echo '<option value="10" id="10">Trilha de aprendizagem</option>';
                                                echo '<option value="11" id="11"">Webinar</option>';
                                            }else if((int)$data['temas'] == 4){
                                                echo '<option value="1" id="1">Campanha de saúde</option>';
                                                echo '<option value="2" id="2">Capacitação</option>';
                                                echo '<option value="3" id="3">Curso</option>';
                                                echo '<option value="4" id="4" selected="selected">Fiscalização Orientativa</option>';
                                                echo '<option value="5" id="5">Encontro</option>';
                                                echo '<option value="6" id="6">Fórum</option>';
                                                echo '<option value="7" id="7">Palestra</option>';
                                                echo '<option value="8" id="8">Seminário</option>';
                                                echo '<option value="9" id="9">Simpósio</option>';
                                                echo '<option value="10" id="10">Trilha de aprendizagem</option>';
                                                echo '<option value="11" id="11"">Webinar</option>';
                                            }else if((int)$data['temas'] == 5){
                                                echo '<option value="1" id="1">Campanha de saúde</option>';
                                                echo '<option value="2" id="2">Capacitação</option>';
                                                echo '<option value="3" id="3">Curso</option>';
                                                echo '<option value="4" id="4">Fiscalização Orientativa</option>';
                                                echo '<option value="5" id="5" selected="selected">Encontro</option>';
                                                echo '<option value="6" id="6">Fórum</option>';
                                                echo '<option value="7" id="7">Palestra</option>';
                                                echo '<option value="8" id="8">Seminário</option>';
                                                echo '<option value="9" id="9">Simpósio</option>';
                                                echo '<option value="10" id="10">Trilha de aprendizagem</option>';
                                                echo '<option value="11" id="11"">Webinar</option>';
                                            }else if((int)$data['temas'] == 6){
                                                echo '<option value="1" id="1">Campanha de saúde</option>';
                                                echo '<option value="2" id="2">Capacitação</option>';
                                                echo '<option value="3" id="3">Curso</option>';
                                                echo '<option value="4" id="4">Fiscalização Orientativa</option>';
                                                echo '<option value="5" id="5">Encontro</option>';
                                                echo '<option value="6" id="6" selected="selected">Fórum</option>';
                                                echo '<option value="7" id="7">Palestra</option>';
                                                echo '<option value="8" id="8">Seminário</option>';
                                                echo '<option value="9" id="9">Simpósio</option>';
                                                echo '<option value="10" id="10">Trilha de aprendizagem</option>';
                                                echo '<option value="11" id="11"">Webinar</option>';
                                            }else if((int)$data['temas'] == 7){
                                                echo '<option value="1" id="1">Campanha de saúde</option>';
                                                echo '<option value="2" id="2">Capacitação</option>';
                                                echo '<option value="3" id="3">Curso</option>';
                                                echo '<option value="4" id="4">Fiscalização Orientativa</option>';
                                                echo '<option value="5" id="5">Encontro</option>';
                                                echo '<option value="6" id="6">Fórum</option>';
                                                echo '<option value="7" id="7" selected="selected">Palestra</option>';
                                                echo '<option value="8" id="8">Seminário</option>';
                                                echo '<option value="9" id="9">Simpósio</option>';
                                                echo '<option value="10" id="10">Trilha de aprendizagem</option>';
                                                echo '<option value="11" id="11"">Webinar</option>';
                                            }else if((int)$data['temas'] == 8){
                                                echo '<option value="1" id="1">Campanha de saúde</option>';
                                                echo '<option value="2" id="2">Capacitação</option>';
                                                echo '<option value="3" id="3">Curso</option>';
                                                echo '<option value="4" id="4">Fiscalização Orientativa</option>';
                                                echo '<option value="5" id="5">Encontro</option>';
                                                echo '<option value="6" id="6">Fórum</option>';
                                                echo '<option value="7" id="7">Palestra</option>';
                                                echo '<option value="8" id="8" selected="selected">Seminário</option>';
                                                echo '<option value="9" id="9">Simpósio</option>';
                                                echo '<option value="10" id="10">Trilha de aprendizagem</option>';
                                                echo '<option value="11" id="11"">Webinar</option>';
                                            }else if((int)$data['temas'] == 9){
                                                echo '<option value="1" id="1">Campanha de saúde</option>';
                                                echo '<option value="2" id="2">Capacitação</option>';
                                                echo '<option value="3" id="3">Curso</option>';
                                                echo '<option value="4" id="4">Fiscalização Orientativa</option>';
                                                echo '<option value="5" id="5">Encontro</option>';
                                                echo '<option value="6" id="6">Fórum</option>';
                                                echo '<option value="7" id="7">Palestra</option>';
                                                echo '<option value="8" id="8">Seminário</option>';
                                                echo '<option value="9" id="9" selected="selected">Simpósio</option>';
                                                echo '<option value="10" id="10">Trilha de aprendizagem</option>';
                                                echo '<option value="11" id="11"">Webinar</option>';
                                            }else if((int)$data['temas'] == 10){
                                                echo '<option value="1" id="1">Campanha de saúde</option>';
                                                echo '<option value="2" id="2">Capacitação</option>';
                                                echo '<option value="3" id="3">Curso</option>';
                                                echo '<option value="4" id="4">Fiscalização Orientativa</option>';
                                                echo '<option value="5" id="5">Encontro</option>';
                                                echo '<option value="6" id="6">Fórum</option>';
                                                echo '<option value="7" id="7">Palestra</option>';
                                                echo '<option value="8" id="8">Seminário</option>';
                                                echo '<option value="9" id="9">Simpósio</option>';
                                                echo '<option value="10" id="10" selected="selected">Trilha de aprendizagem</option>';
                                                echo '<option value="11" id="11"">Webinar</option>';
                                            }else{
                                                echo '<option value="1" id="1">Campanha de saúde</option>';
                                                echo '<option value="2" id="2">Capacitação</option>';
                                                echo '<option value="3" id="3">Curso</option>';
                                                echo '<option value="4" id="4">Fiscalização Orientativa</option>';
                                                echo '<option value="5" id="5">Encontro</option>';
                                                echo '<option value="6" id="6">Fórum</option>';
                                                echo '<option value="7" id="7">Palestra</option>';
                                                echo '<option value="8" id="8">Seminário</option>';
                                                echo '<option value="9" id="9">Simpósio</option>';
                                                echo '<option value="10" id="10" >Trilha de aprendizagem</option>';
                                                echo '<option value="11" id="11" selected="selected">Webinar</option>';
                                            }
                                            ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group data" id="inicial">
                                <div class="form-label-group">
                                    <label for="">Data evento:</label>
                                <input id="date" type="date" name="data" value="<?php echo date_format(new DateTime($data["data"]), "Y-m-d"); ?>" >
                                </div>
                            </div>

                            <div class="form-group data" id="inicial" style="margin-left: 21%; margin-top: -6%;">
                                    <div class="form-label-group">
                                        <label for="">Data expiração evento:</label>
                                        <input id="dateE" type="date" name="dataExc" value="<?php echo date_format(new DateTime($data["data_exc"]), "Y-m-d"); ?>">
                                    </div>
                                </div>

                            <div class="form-group forma">
                                <div class="form-label-group" required>
                                    <select id="forma" name="forma" class="form-control">
                                        <?php
                                            if ((int)$data['forma'] == 1) {
                                                echo '<option value="1" id="1" selected="selected">Presencial</option>';
                                                echo '<option value="2" id="2">On-line</option>';
                                            } else {
                                                echo '<option value="1" id="1">Presencial</option>';
                                                echo '<option value="2" id="2" selected="selected">On-line</option>';
                                            }
                                            ?>
                                    </select>
                                </div>
                            </div>

                            <div class=" oculto cidades">
                                <div class="questao">
                                    <select id="cidades" name="cidades" class="form-control">
                                        <option selected="selected">Selecione o município</option>

                                        <?php
                                            foreach ($cidades as $key => $cidade) {
                                                if ($cidade['uf'] == '26') {
                                                    if($cidade['id'] == $data['municipio']){
                                                        echo "<option  value='" . $cidade['id'] . "' selected >" . $cidade['nome'] . "</option>";
                                                    }else{
                                                        echo "<option  value='" . $cidade['id'] . "' >" . $cidade['nome'] . "</option>";
                                                    }

                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            </br></br>

                            <div class="form-group">
                                <?php if (isset($validation)) : ?>
                                <div class="alert alert-danger" roles="alert">
                                    <?= $validation->listErrors(); ?>
                                </div>
                                <?php endif; ?>
                                <button class="btn btn-primary  text-uppercase" id="cad"
                                    type="submit">Alterar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    } else {
        echo "<h3>Não tem permissão para acessar essa página!</h3>";
    }
    ?>
</main>
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

    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
<?= $this->endSection() ?>