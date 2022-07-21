<?= $this->extend('templates/default'); ?>
<?= $this->section('css'); ?>
<style>
    .form-row .form-group {
        justify-content: space-between;
    }

    .form-row label {
        justify-content: initial;
        width: inherit;
    }
</style>
<?= $this->endSection(); ?>
<?= $this->section('content') ?>
<main id="t3-content">
    <?php
    if (
        isset($_SESSION['id']) &&
        $_SESSION['type'] == 0
    ) {
    ?>
        <div class="row">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('inicio') ?>">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('alterarAtividades') ?>">Atividades</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cadastrar</li>
                    </ol>
                </nav>
                <div class="mx-auto ">
                    <div class="card">
                        <div class="card-body">                            
                            <h2 class="card-title text-center col-12">Cadastro de Atividade</h2>
                            <?php
                            foreach ($data as $key => $evento) {
                            } ?>
                            <form class="form-signin" name='form1' method="POST">
                                <div class="form-group ">
                                    <div class="form-label-group" required>
                                        <script>
                                            $("#selectEvent").on("change", function() {

                                                idEventoJs = $("#selectEvent").val();
                                                alert(idEventoJs);
                                                $.ajax({});

                                            });
                                        </script>
                                        <select id="selectEvent" name="selectEvent" class="form-control col-12" required onchange="atribuir(this)">
                                            <option selected disabled>Eventos</option>
                                            <?php
                                            foreach ($data as $key => $evento) {
                                                echo "<option value='" . $evento['id'] . "' title='" . $evento['dtInicio'] . "|" . $evento['dtFim'] . "'>" . $evento['id'] . " - " . $evento['titulo'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <input type="text" id="titulo" name="titulo" class="form-control col-12" placeholder="Titulo" maxlength="60" minilength="3" required autofocus>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <textarea type="text" name="atividade" id="atividade" class="form-control col-12" placeholder="Atividade" autofocus required></textarea>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for="dtAgenda">Data Ini.</label>
                                        <input type="date" name="datainicial" id="dtAgenda" min="
                                <?php foreach ($data as $key => $evento) {

                                    echo date_format(new DateTime($evento['dtInicio']), "Y-m-d");
                                } ?>" max="
                                <?php foreach ($data as $key => $evento) {

                                    echo date_format(new DateTime($evento['dtFim']), "Y-m-d");
                                } ?>" class="form-control" required />
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="hora">Hora Ini.</label>
                                        <input type="time" name="hinicial" id="hora" class="form-control"" required />                                    
                                    </div>
                                    <div class=" form-group col-md-2">
                                        <label for="dtAgenda1">Data Fim.</label>
                                        <input type="date" name="datafinal" id="dtAgenda1" min="
                                    <?php foreach ($data as $key => $evento) {
                                        echo date_format(new DateTime($evento['dtInicio']), "Y-m-d");
                                    } ?>" max="  
                                    <?php foreach ($data as $key => $evento) {
                                        echo date_format(new DateTime($evento['dtFim']), "Y-m-d");
                                    } ?>" class="form-control" required />
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="hora2">Hora Fim.</label>
                                        <input type="time" name="hfinal" id="hora2" class="form-control" required />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="certificado">Certificado</label>
                                        <select id="certificado" name="certificado" class="form-control">
                                            <option selected disabled>Certificado</option>
                                            <option value="1">Gera certificado</option>
                                            <option value="2">Não gera certificado</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group text-right">
                                    <?php if (isset($validation)) : ?>
                                        <div class="alert alert-danger" roles="alert">
                                            <?= $validation->listErrors(); ?>
                                        </div>
                                    <?php endif; ?>
                                    <button class="btn btn-primary" id="cad" type="submit">Cadastrar</button>
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
<?= $this->endSection() ?>

<?= $this->section('js'); ?>
<script>
    function atribuir(elem) {
        var datas = elem.options[elem.selectedIndex].getAttribute("title").split("|");
        var dtINI = document.getElementById("dtAgenda");
        var dtFIM = document.getElementById("dtAgenda1");

        var min = new Date(datas[0]);
        min = (min.getFullYear() + "-" + adicionaZero(((min.getMonth() + 1))) + "-" + adicionaZero((min.getDate())));

        var max = new Date(datas[1]);
        max = (max.getFullYear() + "-" + adicionaZero(((max.getMonth() + 1))) + "-" + adicionaZero((max.getDate())));

        dtINI.setAttribute("min", min);
        dtINI.setAttribute("max", max);
        dtFIM.setAttribute("min", min);
        dtFIM.setAttribute("max", max);
    }

    function adicionaZero(numero) {
        if (numero <= 9)
            return "0" + numero;
        else
            return numero;
    }
</script>
<?= $this->endSection() ?>